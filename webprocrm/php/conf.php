<?php

/************
 * Connection
 ************/

class ConVar {
    public $host;
    public $user;
    public $pass;
    public $db;

    function __construct($h= DB_HOST, $u= DB_USER, $p= '', $d){
        $this->host= $h;
        $this->user= $u;
        $this->pass= $p;
        $this->db= $d;
    }
}
class MySqlConnect {
    protected $link;

    function __construct($h= DB_HOST, $u= DB_USER, $p= '', $d){
        $this->link= mysql_connect($h, $u, $p) or
        die("Could not connect: " . mysql_error());
        mysql_select_db($d, $this->link);
        mysql_set_charset(DB_CHARSET);
    }
    function query($text, $fetch= 'assoc'){
        $result = mysql_query($text, $this->link);
        $rows= array();
        if ( is_resource($result)) {
            if ($fetch == 'assoc')
                while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
                    $rows[]= $row;
            else
                while ($row = mysql_fetch_array($result, MYSQL_NUM))
                    $rows[]= $row;
            mysql_free_result($result);
            return $rows;
        } else
            return $result;
    }
    function close() {
        mysql_close($this->link);
    }
}
class MySqliConnect extends mysqli {
    function __construct($h= DB_HOST, $u= DB_USER, $p= '', $d){
        parent::__construct($h, $u, $p, $d);
        if ($this->connect_errno) {
            echo "Failed to connect to MySQL: (" . $this->connect_errno . ") " . $this->connect_error;
        }
        $this->set_charset ( DB_CHARSET );
    }
    function query($text, $fetch= 'assoc'){
        $result = parent::query($text);
        $rows= array();
        if ( !is_bool($result)) {
            if ($fetch == 'assoc')
                while ($row = $result->fetch_assoc())
                    $rows[]= $row;
            else
                while ($row = $result->fetch_array(MYSQLI_NUM))
                    $rows[]= $row;
            $result->close();
            return $rows;
        } else
            return $result;
    }
}


class DBConnect {
    public $local;
    public $host;
    public $ctype= 'auto';
    public $htype= 'auto';
    public $hpreg= array('127.0.0', 'localhost', '.su');
    public $link;


    function __construct($lh, $lu, $lp, $ld,  $hh, $hu, $hp, $hd) {
        $this->local= new ConVar($lh, $lu, $lp, $ld);
        $this->host= new ConVar($hh, $hu, $hp, $hd);
    }

    protected function checkphp(){
        if (phpversion() >= '5.0')
            $this->ctype= 'mysqli';
        else
            $this->ctype= 'mysql';
    }
    protected function checkhost(){
        foreach($this->hpreg as $val) {
            if ( mb_stripos($_SERVER["HTTP_HOST"], $val) !== false) {
                $this->htype= 'local';
                return;
            }
        }
        $this->htype= 'remout';
    }
    public function query($text, $fetch='assoc') {return $this->link->query($text, $fetch);}

    public function connect() {
        if ($this->ctype == 'auto') $this->checkphp();
        if ($this->htype == 'auto') $this->checkhost();

        $h= '';
        $u= '';
        $p= '';
        $d= '';
        if ($this->htype == 'local') {
            $h= $this->local->host;
            $u= $this->local->user;
            $p= $this->local->pass;
            $d= $this->local->db;
        } else {
            $h= $this->host->host;
            $u= $this->host->user;
            $p= $this->host->pass;
            $d= $this->host->db;
        }
        if ($this->ctype == 'mysqli')
            $this->link= new MySqliConnect($h, $u, $p, $d);
        else
            $this->link= new MySqlConnect($h, $u, $p, $d);
    }

    function __destruct(){
        $this->link->close();
    }

    function gettbl($tbl, $fetch='assoc') {
        return $this->query("SELECT * FROM ".$tbl, $fetch);
    }
}

//$link= new DBConnect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME,
//    DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
//$link->connect();
//var_dump($link->gettbl('br_cominfo'));
?>