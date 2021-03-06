<?php
require_once __DIR__."/rbac.php";

class jf
{
	/**
	 * @var RBACManager
	 */
	public static $RBAC;
	
	public static $DB = null;

	static function TablePrefix()
	{
		return "phprbac_";
	}
	/**
	 * The jf::SQL function. The behavior of this function is as follows:
	 * On queries with no parameters, it should use query function and fetch all results (no prepared statement)
	 * On queries with parameters, parameters are provided as question marks (?) and then additional function arguments will be
	 * 	bound to question marks.
	 * On SELECT, it will return 2D array of results or NULL if no result.
	 * On DELETE, UPDATE it returns affected rows
	 * On INSERT, if auto-increment is available last insert id, otherwise affected rows
	 * @todo currently sqlite always returns sequence number for lastInsertId, so there's no way of knowing if insert worked instead of exectue result. all instances of ==1 replaced with >=1 to check for insert
	 * @param string $Query
	 * @throws Exception
	 * @return array|integer|null
	 */
	static function SQL($Query)
	{
		$args = func_get_args ();
		if (get_class ( self::$DB ) == "PDO")
			return call_user_func_array ( "self::SQL_pdo", $args );
		else 
			if (get_class ( self::$DB ) == "mysqli")
				return call_user_func_array ( "self::SQL_mysqli", $args );
			else
				throw new Exception ( "Unknown database interface type." );
	}
	static function SQL_pdo($Query)
	{
		$args = func_get_args ();
		if (count ( $args ) == 1)
		{
			$result = self::$DB->query ( $Query );
			if ($result===false)
				return null;
			$res=$result->fetchAll ( PDO::FETCH_ASSOC );
			if ($res===array())
				return null;
			return $res;
		}
		else
		{
			if (! $stmt = self::$DB->prepare ( $Query ))
			{
				$Error = self::$DB->errorInfo ();
				trigger_error ( "Unable to prepare statement: {$Query}, reason: {$Error[2]}" );
			}
			array_shift ( $args ); // remove $Query from args
			$i = 0;
			foreach ( $args as &$v )
				$stmt->bindValue ( ++ $i, $v );
			$success=$stmt->execute ();
			
			$type = substr ( trim ( strtoupper ( $Query ) ), 0, 6 );
			if ($type == "INSERT")
			{
				if (!$success)
					return null;
				$res = self::$DB->lastInsertId ();
				if ($res == 0)
					return $stmt->rowCount ();
				return $res;
			}
			elseif ($type == "DELETE" or $type == "UPDATE" or $type == "REPLAC")
				return $stmt->rowCount ();
			elseif ($type == "SELECT")
			{
				$res=$stmt->fetchAll ( PDO::FETCH_ASSOC );
				if ($res===array())
					return null;
				else
					return $res;
			}
		}
	}
	static function SQL_mysqli( $Query)
	{
		$args = func_get_args ();
		if (count ( $args ) == 1)
		{
			$result = self::$DB->query ( $Query );
			if ($result===true)
				return true;
			if ($result && $result->num_rows)
			{
				$out = array ();
				while ( null != ($r = $result->fetch_array ( MYSQLI_ASSOC )) )
					$out [] = $r;
				return $out;
			}
			return null;
		}
		else
		{
			if (! $preparedStatement = self::$DB->prepare ( $Query ))
				trigger_error ( "Unable to prepare statement: {$Query}, reason: ".self::$DB->error );
			array_shift ( $args ); // remove $Query from args
			$a = array ();
			foreach ( $args as $k => &$v )
				$a [$k] = &$v;
			$types = str_repeat ( "s", count ( $args ) ); // all params are
			                                              // strings, works well on
			                                              // MySQL
			                                              // and SQLite
			array_unshift ( $a, $types );
			call_user_func_array ( array ($preparedStatement, 'bind_param' ), $a );
			$preparedStatement->execute ();
			
			$type = substr ( trim ( strtoupper ( $Query ) ), 0, 6 );
			if ($type == "INSERT")
			{
				$res = self::$DB->insert_id;
				if ($res == 0)
					return self::$DB->affected_rows;
				return $res;
			}
			elseif ($type == "DELETE" or $type == "UPDATE" or $type == "REPLAC")
				return self::$DB->affected_rows;
			elseif ($type == "SELECT")
			{
				// fetching all results in a 2D array
				$metadata = $preparedStatement->result_metadata ();
				$out = array ();
				$fields = array ();
				if (! $metadata)
					return null;
				while ( null != ($field = $metadata->fetch_field ()) )
					$fields [] = &$out [$field->name];
				call_user_func_array ( array ($preparedStatement, "bind_result" ), $fields );
				$output = array ();
				$count = 0;
				while ( $preparedStatement->fetch () )
				{
					foreach ( $out as $k => $v )
						$output [$count] [$k] = $v;
					$count ++;
				}
				$preparedStatement->free_result ();
				return ($count == 0) ? null : $output;
			}
			else
				return null;
		}
	}
	
	static function time()
	{
		return time();
	} 
}

jf::$RBAC=new RBACManager();
require_once __DIR__."/../setup.php";