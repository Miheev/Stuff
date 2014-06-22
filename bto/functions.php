<?
class DB {
	var $server = 'localhost';
	var $login = 'webpro-web3';
	var $password = '3amknpm3';
	var $database = 'adminka-bto';
	var $connection;
	var $message;
	
	function init() {
		$this->connection = mysql_connect($this->server,$this->login,$this->password);
		mysql_select_db($this->database,$this->connection);
		mysql_query ("SET NAMES `cp1251`");  
		mysql_query ("set character_set_client='cp1251'");    
		mysql_query ("set character_set_results='cp1251'");    
		mysql_query ("set collation_connection='cp1251_general_ci'");
	}
	
	function query ($text) {
		return mysql_query($text,$this->connection);
	}
	
	function fetch ($text) {
		return mysql_fetch_array($this->query($text));
	}
		
	function stringClear($txt) {
		$l = array ('`','"',"'",'from','FROM','union','UNION','SELECT','select','INSERT','insert','DELETE','delete');
		$f = array ('','','','','','','','','','','','','','','');
		$txt = strip_tags($txt);
		$txt = trim($txt);
		$txt = str_replace($l,$f,$txt);
		return $txt;
	}
	
	function checkUser($l,$p) {
		$l = $this->stringClear($l);
		$p = $this->stringClear($p);
		$p = md5($p);
		$u = $this->query("SELECT * FROM users WHERE email='".$l."' AND pass='".$p."' LIMIT 1");
		if ($u && mysql_num_rows($u) > 0):
			$u = mysql_fetch_array($u);
			$_SESSION["agpd"] = $p;
			$_SESSION["appd"] = $u['type'];
			$_SESSION['appl'] = $u["email"];
			return true;
		else:
			return false;
		endif;
	}
	
	function generatePassword($length = 8) {
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $count = mb_strlen($chars);

    for ($i = 0, $result = ''; $i < $length; $i++) {
        $index = rand(0, $count - 1);
        $result .= mb_substr($chars, $index, 1);
    }

    return $result;
	}
	
	function resetPass($l) {
		$l = $this->stringClear($l);
		$u = $this->query("SELECT * FROM users WHERE email='".$l."' LIMIT 1");
		if ($u && mysql_num_rows($u) > 0):
			$u = mysql_fetch_array($u);
			$np = $this->generatePassword();
			$this->query("UPDATE users SET pass='".md5($np)."' WHERE ID='".$u["ID"]."'");
			
			$massage = "Вы сбросили пароль на сайте БТО.\nТеперь вы можете войти со следующими данными.\nВаш логин: ".$u['email']."\nВаш новый пароль: ".$np."\n\nАдминистрация БТО";
			
			mail($u["email"], 'Сброс пароля', $message);
			return true;
		else:
			return false;
		endif;
	}
	
	function secureDestroy() {
		unset($_SESSION['auth']);
		unset($_SESSION['time']);
		unset($_SESSION['agpd']);
		unset($_SESSION['appd']);
		unset($_SESSION['appl']);
		$_SESSION["error"] = 'error';
		header ("location: /");
	}
	
	
	
	function checkValidUser($i) {
		if (!empty($i["agpd"]) && !empty($i["appd"])):
			$u = $this->query("SELECT * FROM users WHERE email='".$i["appl"]."' AND pass='".$i["agpd"]."' LIMIT 1");
			if (mysql_num_rows($u) > 0):
				if ($i["time"] < time() - 900):
					$this->secureDestroy();
				else:
					$_SESSION["time"] = time();
				endif;
			else:
				$this->secureDestroy();
			endif;
		else:
			$this->secureDestroy();
		endif;
	}
	
	function getUserByEmail($e) {
		return $this->fetch("SELECT * FROM users WHERE `email`='".$e."'");
	}
	
	function getUserByID($ID) {
		return $this->fetch("SELECT * FROM users WHERE `ID`='".$ID."'");
	}
	
	function formatFIO ($user) {
		return $user["f"].' '.$user["i"][0].'.'.$user["o"][0];
	}
	
	function getClientsList() {
		$info = $this->query("SELECT * FROM users WHERE `type`='client' ORDER BY f ASC");
		echo '<table align="center" border="0" class="clients"><tr><th>Организация (ФИО)</th><th>E-mail</th><th>Город</th><th>Дата регистрации</th><th style="width:75px">Действия</th></tr>';
		while ($i = mysql_fetch_array($info)):
			echo '<tr><td><a href="/admin/?page=clients&act=view&ID='.$i["ID"].'">'.((!empty($i["org"])) ? $i["org"] : $this->formatFIO($i)).'</a></td><td>'.$i["email"].'</td><td>'.$i["city"].'</td><td>'.date("d.m.Y",$i["date"]).'</td><td align="center"><a href="/admin/?page=clients&act=edit&ID='.$i["ID"].'" title="Редактировать запись"><img src="/edit.png" width=15 border=0></a>&nbsp;&nbsp;&nbsp;<a href="/admin/?page=clients&act=delete&ID='.$i["ID"].'" title="Удалить запись"><img src="/delete.png" width=15 border=0></a></td></tr>';
		endwhile;
		echo '</table>';
	}
    function findClientsList($key) {
        $info = $this->query("SELECT * FROM users where (f='$key' or i='$key' or f='$key' or org='$key') and `type`='client' ORDER BY f ASC");
        if (mysql_num_rows($info)) // Если найдена хотя-бы одна строка
        {
            echo '<table align="center" border="0" class="clients"><tr><th>Организация (ФИО)</th><th>E-mail</th><th>Город</th><th>Дата регистрации</th><th style="width:75px">Действия</th></tr>';
            while ($i = mysql_fetch_array($info)):
                echo '<tr><td><a href="/admin/?page=clients&act=view&ID='.$i["ID"].'">'.((!empty($i["org"])) ? $i["org"] : $this->formatFIO($i)).'</a></td><td>'.$i["email"].'</td><td>'.$i["city"].'</td><td>'.date("d.m.Y",$i["date"]).'</td><td align="center"><a href="/admin/?page=clients&act=edit&ID='.$i["ID"].'" title="Редактировать запись"><img src="/edit.png" width=15 border=0></a>&nbsp;&nbsp;&nbsp;<a href="/admin/?page=clients&act=delete&ID='.$i["ID"].'" title="Удалить запись"><img src="/delete.png" width=15 border=0></a></td></tr>';
            endwhile;
            echo '</table>';
        } else echo "<table><tbody><tr><td>По данному запросу ничего не найдено</td></tr></tbody></table>";
    }
	
	function addNewConstant($R) {
		$types = implode('|',$R["cat"]);
		$costs = implode('|',$R["price"]);
		$this->query("INSERT INTO prices VALUES ('','".$R["name"]."', '".$types."', '".$costs."')");
	}
	
	function getConstants() {
		$info = $this->query("SELECT * FROM prices ORDER BY id ASC");
		while ($i = mysql_fetch_array($info)):
			$cats = explode('|',$i["cats"]);
			$costs = explode('|',$i["costs"]);
			$VT = array (
				'name' => $i["name"],
				'cats' => $cats,
				'costs' => $costs,
				'num' => count($cats)
			);
			echo '<table><tr><td style="width:200px" valign="top"><h3>'.$VT["name"].'</h3></td><td><table>';
			foreach ($VT["cats"] as $k=>$v):
				echo '<tr><td>Категория '.$VT["cats"][$k].'</td><td>'.$VT["costs"][$k].'</td></tr>';
			endforeach;
			echo '</table></td><td valign="top" style="width:30px;" align="center"><a href="/admin/?page=constants&act=edit&ID='.$i["ID"].'" title="Редактировать запись"><img src="/edit.png" width="15" style="margin:5px;"></a><br /><a href="/admin/?page=constants&act=delete&ID='.$i["ID"].'" title="Удалить запись"><img src="/delete.png" width="15" style="margin-top:5px;"></a></td></tr></table><br /><br />';
		endwhile;
	}
	
	function getConstantsArray($ID) {
		$info = $this->query("SELECT * FROM prices WHERE ID='".$ID."'");
		while ($i = mysql_fetch_array($info)):
			$cats = explode('|',$i["cats"]);
			$costs = explode('|',$i["costs"]);
			$VT = array (
				'name' => $i["name"],
				'cats' => $cats,
				'costs' => $costs,
				'num' => count($cats)
			);
		endwhile;
		return $VT;
	}
	
	function getConstantSelectbox ($i = '' ) {
		$info = $this->query("SELECT * FROM prices ORDER BY id ASC");
		echo '<select name="cost_type" class="form-control">';
		while ($i = mysql_fetch_array($info)):
			echo '<option value="'.$i["ID"].'">'.$i["name"].'</option>';
		endwhile;
		echo '</select>';
	}
	
	function addNewClient($i) {
		$this->query("INSERT INTO users VALUES ('', '".$i["f"]."', '".$i["i"]."', '".$i["o"]."', '".$i["org"]."', '".$i["city"]."', '".$i["phone"]."', '".$i["email"]."', '".md5($i["pass"])."', '".$i["cost_type"]."', 'client', '".time()."')");
	}
	
	function deleteClient($ID) {
		$this->query("DELETE FROM users WHERE ID='".$ID."'");
	}
	
	function rewriteConstant($i) {
		$types = implode('|',$i["cat"]);
		$costs = implode('|',$i["price"]);
		while (substr_count($types,'||') > 0) str_replace('||','|',$types);
		while (substr_count($costs,'||') > 0) str_replace('||','|',$costs);
		if ($types[strlen($types)-1] == '|') $types = substr($types,0,strlen($types)-1);
		if ($costs[strlen($costs)-1] == '|') $costs = substr($costs,0,strlen($costs)-1);
		$this->query("UPDATE prices SET name='".$i["name"]."', cats='".$types."', costs='".$costs."' WHERE ID='".$i["ID"]."'");
	}
	
	function deleteConstant($ID) {
		$this->query("DELETE FROM prices WHERE ID='".$ID."'");
	}
	
	function rewriteClient($i) {
		if (!empty($i["pass"])): $add = ", pass='".md5($i["pass"])."'"; 
		else: $ass = '';
		endif;
		$this->query("UPDATE users SET f='".$i["f"]."', i='".$i["i"]."', o='".$i["o"]."', org='".$i["org"]."', phone='".$i["phone"]."', city='".$i["city"]."', org='".$i["org"]."', cost='".$i["cost_type"]."', email='".$i["email"]."' ".$add." WHERE ID='".$i["ID"]."'");
	}
	
	function updateClientPass($i) {
		$u = $this->getUserByEmail($_SESSION["appl"]);
		if ($u["pass"] == md5($i["pass"]) && $_SESSION["agpd"] == md5($i["pass"]) && $i["npass1"] == $i["npass2"]):
			$this->query("UPDATE users SET pass='".md5($i["npass1"])."' WHERE ID='".$u["ID"]."'");
			$_SESSION["agpd"] = md5($i["npass1"]);
		endif;
	}
	
	function addNewTS($p) {
		$u = $this->getUserByEmail($_SESSION["appl"]);
		$query = "INSERT INTO ts VALUES (
			'',
			'".$p["f"]."',
			'".$p["i"]."',
			'".$p["o"]."',
			'".$p["num"]."',
			'".$p["vin"]."',
			'".$p["mark"]."',
			'".$p["model"]."',
			'".$p["cat"]."',
			'".$p["year"]."',
			'".$p["rama"]."',
			'".$p["kuz"]."',
			'".$p["rmm"]."',
			'".$p["breaks"]."',
			'".$p["oil"]."',
			'".$p["mbn"]."',
			'".$p["tyres"]."',
			'".$p["aim"]."',
			'".$p["run"]."',
			'".$p["doc"]."',
			'".$p["dser"]."',
			'".$p["dnum"]."',
			'".$p["ddate"]."',
			'".$p["bywho"]."',
			'".$p["diagdate"]."',
			'".$p["diag_srok"]."',
			'".$p["diag_until"]."',
			'".$p["diag_cost"]."',
			'".$p["addon"]."',
			'".time()."',
			'".$u["ID"]."',
			'')";
		$this->query($query);
		$m = $this->fetch("SELECT MAX(ID) FROM ts");
		$m = $m[0];
		$d = date("Ymd");
		$eaisto = $this->formatEAISTO($m,$d);
		$this->query("UPDATE ts SET eaisto='".$eaisto."' WHERE ID='".$m."'");
		return $eaisto;
	}
	
	function formatEAISTO($m,$d) {
		while (strlen($m) < 13):
			$m ='0'.$m;
		endwhile;
		return $d.$m;
	}
	
	function getTSList($o) {
		$srok = array (
			"6m" => "6 месяцев",
			"12m" => "12 месяцев",
			"24m" => "24 месяца"
		);
		
		$info = $this->query("SELECT * FROM ts WHERE owner='".$o."' ORDER BY ID ASC");
		
		echo '<table align="center" border="0" class="clients"><tr><th>&nbsp;</th><th>Заявитель</th><th>Срок</th><th>Код ЕАИСТО</th><th>ТС</th><th>Категория</th><th>VIN/Номер кузова</th><th>Стоимость</th><th style="width:75px">Просмотр</th></tr>';
		while ($i = mysql_fetch_array($info)):
			switch ($i["cat"]):
				case 'M1':
				case 'N1': $cat = 'Категория B ('.$i["cat"].')'; break;
				case 'N2':
				case 'N3': $cat = 'Категория C ('.$i["cat"].')'; break;
				case 'M2':
				case 'M3': $cat = 'Категория D ('.$i["cat"].')'; break;
				case 'O1':
				case 'O2':
				case 'O3':
				case 'O4': $cat = 'Категория E ('.$i["cat"].')'; break;
			endswitch;
			echo '<tr>
				<td>'.date("d.m.Y",$i["sdate"]).'</td>
				<td>'.$this->formatFIO($i).'</td>
				<td>'.$srok[$i["srok"]].'</td>
				<td>'.$i["eaisto"].'</td>
				<td>'.$i["mark"].' '.$i["model"].'</td>
				<td>'.$cat.'</td>
				<td>'.((!empty($i["vin"]) ? $i["vin"] : $i["kuz"])).'</td>
				<td align="right">'.$i["cost"].'</td>
				<td style="widtd:75px"><a href="/print/?id='.$i["eaisto"].'">ТО</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/print/tch.php?id='.$i["eaisto"].'">ТЧ</a></td>
			</tr>';
		endwhile;
		echo '</table>';
	}
    function findTSList($o, $key) {
        $srok = array (
            "6m" => "6 месяцев",
            "12m" => "12 месяцев",
            "24m" => "24 месяца"
        );
var_dump($key);
        $tmp= intval($key);
        if ($tmp > 0)
            $info = $this->query("SELECT * FROM ts where eaisto='$key' ORDER BY ID ASC");
        else
            $info = $this->query("SELECT * FROM ts t join users u on t.owner = u.ID where (u.f='$key' or u.i='$key' or u.o='$key') ORDER BY t.ID ASC");

        if (mysql_num_rows($d_table)) // Если найдена хотя-бы одна строка
        {
            echo '<table align="center" border="0" class="clients"><tr><th>&nbsp;</th><th>Заявитель</th><th>Срок</th><th>Код ЕАИСТО</th><th>ТС</th><th>Категория</th><th>VIN/Номер кузова</th><th>Стоимость</th><th style="width:75px">Просмотр</th></tr>';
            while ($i = mysql_fetch_array($info)):
                switch ($i["cat"]):
                    case 'M1':
                    case 'N1': $cat = 'Категория B ('.$i["cat"].')'; break;
                    case 'N2':
                    case 'N3': $cat = 'Категория C ('.$i["cat"].')'; break;
                    case 'M2':
                    case 'M3': $cat = 'Категория D ('.$i["cat"].')'; break;
                    case 'O1':
                    case 'O2':
                    case 'O3':
                    case 'O4': $cat = 'Категория E ('.$i["cat"].')'; break;
                endswitch;
                echo '<tr>
				<td>'.date("d.m.Y",$i["sdate"]).'</td>
				<td>'.$this->formatFIO($i).'</td>
				<td>'.$srok[$i["srok"]].'</td>
				<td>'.$i["eaisto"].'</td>
				<td>'.$i["mark"].' '.$i["model"].'</td>
				<td>'.$cat.'</td>
				<td>'.((!empty($i["vin"]) ? $i["vin"] : $i["kuz"])).'</td>
				<td align="right">'.$i["cost"].'</td>
				<td style="widtd:75px"><a href="/print/?id='.$i["eaisto"].'">ТО</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/print/tch.php?id='.$i["eaisto"].'">ТЧ</a></td>
			</tr>';
            endwhile;
            echo '</table>';

        } else echo "<table><tbody><tr><td>По данному запросу ничего не найдено</td></tr></tbody></table>";
    }
	
	function printTSList($o, &$eaid) {
		$d_table=mysql_query("SELECT * FROM ts WHERE eaisto='".$eaid."'");
		if (mysql_num_rows($d_table)) // Если найдена хотя-бы одна строка
			{
				$eaid=mysql_fetch_array($d_table);
				
			}
	}
	
	
	function getAdminTSList() {
		$srok = array (
			"6m" => "6 месяцев",
			"12m" => "12 месяцев",
			"24m" => "24 месяца"
		);
		
		$info = $this->query("SELECT * FROM ts ORDER BY ID ASC");
		
		echo '<table align="center" border="0" id="clients" class="clients tablesorter"><thead><tr><th>Дата</th><th>Организация</th><th>Срок</th><th>Код ЕАИСТО</th><th>Заявитель</th><th>ТС</th><th>Категория</th><th>VIN/Номер кузова</th><th>Стоимость</th><th style="width:75px">Просмотр</th></tr></thead>';
		echo '<tbody>';
		while ($i = mysql_fetch_array($info)):
			switch ($i["cat"]):
				case 'M1':
				case 'N1': $cat = 'Категория B ('.$i["cat"].')'; break;
				case 'N2':
				case 'N3': $cat = 'Категория C ('.$i["cat"].')'; break;
				case 'M2':
				case 'M3': $cat = 'Категория D ('.$i["cat"].')'; break;
				case 'O1':
				case 'O2':
				case 'O3':
				case 'O4': $cat = 'Категория E ('.$i["cat"].')'; break;
			endswitch;
			
			$o = $this->getUserByID($i["owner"]);
			
			echo '<tr>
				<td>'.date("d.m.Y",$i["sdate"]).'</td>
				<td>'.((!empty($o["org"])) ? $o["org"] : $this->formatFIO($o)).'</td>
				<td>'.$srok[$i["srok"]].'</td>
				<td>'.$i["eaisto"].'</td>
				<td>'.$this->formatFIO($i).'</td>
				<td>'.$i["mark"].' '.$i["model"].'</td>
				<td>'.$cat.'</td>
				<td>'.((!empty($i["vin"]) ? $i["vin"] : $i["kuz"])).'</td>
				<td align="right">'.$i["cost"].'</td>
				<td style="widtd:75px"><a href="/print/?id='.$i["eaisto"].'">ТО</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/print/tch.php?id='.$i["eaisto"].'">ТЧ</a></td>
			</tr>';
		endwhile;
		echo '</tbody>';
		echo '</table>';
	}
    function findAdminTSList($key) {
        $srok = array (
            "6m" => "6 месяцев",
            "12m" => "12 месяцев",
            "24m" => "24 месяца"
        );

        $tmp= intval($key);
        if ($tmp > 0)
            $info = $this->query("SELECT * FROM ts where eaisto='$key' ORDER BY ID ASC");
        else
            $info = $this->query("SELECT * FROM ts t join users u on t.owner = u.ID where u.f='$key' ORDER BY t.ID ASC");
        if (mysql_num_rows($info)) // Если найдена хотя-бы одна строка
        {
            echo '<table align="center" border="0" id="clients" class="clients tablesorter"><thead><tr><th>Дата</th><th>Организация</th><th>Срок</th><th>Код ЕАИСТО</th><th>Заявитель</th><th>ТС</th><th>Категория</th><th>VIN/Номер кузова</th><th>Стоимость</th><th style="width:75px">Просмотр</th></tr></thead>';
            echo '<tbody>';
            while ($i = mysql_fetch_array($info)):
                switch ($i["cat"]):
                    case 'M1':
                    case 'N1': $cat = 'Категория B ('.$i["cat"].')'; break;
                    case 'N2':
                    case 'N3': $cat = 'Категория C ('.$i["cat"].')'; break;
                    case 'M2':
                    case 'M3': $cat = 'Категория D ('.$i["cat"].')'; break;
                    case 'O1':
                    case 'O2':
                    case 'O3':
                    case 'O4': $cat = 'Категория E ('.$i["cat"].')'; break;
                endswitch;

                $o = $this->getUserByID($i["owner"]);

                echo '<tr>
				<td>'.date("d.m.Y",$i["sdate"]).'</td>
				<td>'.((!empty($o["org"])) ? $o["org"] : $this->formatFIO($o)).'</td>
				<td>'.$srok[$i["srok"]].'</td>
				<td>'.$i["eaisto"].'</td>
				<td>'.$this->formatFIO($i).'</td>
				<td>'.$i["mark"].' '.$i["model"].'</td>
				<td>'.$cat.'</td>
				<td>'.((!empty($i["vin"]) ? $i["vin"] : $i["kuz"])).'</td>
				<td align="right">'.$i["cost"].'</td>
				<td style="widtd:75px"><a href="/print/?id='.$i["eaisto"].'">ТО</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/print/tch.php?id='.$i["eaisto"].'">ТЧ</a></td>
			</tr>';
            endwhile;
            echo '</tbody>';
            echo '</table>';
        } else echo "<table><tbody><tr><td>По данному запросу ничего не найдено</td></tr></tbody></table>";
    }
	
	function getAdminAnalysis_ClientsList($list) {
		$info = $this->query("SELECT * FROM users WHERE `type`='client' ORDER BY f ASC");
		echo '<select name="client" class="form-control" style="width:100%;">';
		echo '<option value="0">Все</option>';
		while ($i = mysql_fetch_array($info)):
			if($list['client'] == $i["ID"]) {
				echo '<option value="'.$i["ID"].'" selected="selected">'.((!empty($i["org"])) ? $i["org"] : $this->formatFIO($i)).'</option>';
			} else {
				echo '<option value="'.$i["ID"].'">'.((!empty($i["org"])) ? $i["org"] : $this->formatFIO($i)).'</option>';
			}
		endwhile;
		echo '</select>';
	}
	
	function getAdminAnalysis_CategoryList($list) {
		
	}
	
	function getAdminAnalysis($list) {
		$query = "SELECT * FROM ts";
		$where = "";
		if($list['client'] > 0) {
			$query = $query." WHERE `owner`=".$list['client'];	
		}
		
		$info = $this->query($query);
		
		if(mysql_num_rows($info) > 0) { 
			?>
			<table class="table table-striped table-analysis">
				<thead>
					<tr>
						<th>Дата:</th>
						<th>Заявитель:</th>
						<th>Категория ТС:</th>
						<th>Стоимость:</th>
					</tr>
				</thead>
				<tbody>
			<?
			while ($i = mysql_fetch_array($info)):
			?>
				<? if(strtotime($i["ddate"])>0 AND strtotime($list["fromdate"]) > 0) { ?>
				<? if((strtotime($i["ddate"])>=strtotime($list["fromdate"])) AND (strtotime($i["ddate"])<=strtotime($list["todate"]))) { ?>
				<tr>
					<td><?echo $i["ddate"];?></td>
					<td><a href="/admin/?page=clients&act=view&ID=<?=$i["owner"]?>"><?echo $this->formatFIO($i);?></a></td>
					<td>
						<?switch ($i["cat"]):
							case 'M1': $cat = 'Категория A ('.$i["cat"].')'; break;
							case 'N1': $cat = 'Категория B ('.$i["cat"].')'; break;
							case 'N2':
							case 'N3': $cat = 'Категория C ('.$i["cat"].')'; break;
							case 'M2':
							case 'M3': $cat = 'Категория D ('.$i["cat"].')'; break;
							case 'O1':
							case 'O2':
							case 'O3':
							case 'O4': $cat = 'Категория E ('.$i["cat"].')'; break;
						endswitch;
						echo $cat;
						?>
					</td>
					<td class="cost">
						<? if(preg_match("/^[0-9]+$/", $i["cost"])) {
								echo $i["cost"]." P.";
						} else {
								echo " - ";
						} ?>
					</td>
				</tr>
				<? } } else {?>
				<? if(strtotime($i["ddate"])>=strtotime($list["fromdate"])) { ?>
				<tr>
					<td><?echo $i["ddate"];?></td>
					<td><a href="/admin/?page=clients&act=view&ID=<?=$i["owner"]?>"><?echo $this->formatFIO($i);?></a></td>
					<td>
						<?switch ($i["cat"]):
							case 'M1': $cat = 'Категория A ('.$i["cat"].')'; break;
							case 'N1': $cat = 'Категория B ('.$i["cat"].')'; break;
							case 'N2':
							case 'N3': $cat = 'Категория C ('.$i["cat"].')'; break;
							case 'M2':
							case 'M3': $cat = 'Категория D ('.$i["cat"].')'; break;
							case 'O1':
							case 'O2':
							case 'O3':
							case 'O4': $cat = 'Категория E ('.$i["cat"].')'; break;
						endswitch;
						echo $cat;
						?>
					</td>
					<td class="cost">
						<? if(preg_match("/^[0-9]+$/", $i["cost"])) {
								echo $i["cost"]." P.";
						} else {
								echo " - ";
						} ?>
					</td>
				</tr>
				<? } } ?>
			<?
			endwhile;
			?>
				<tr class="info">
					<td colspan="3" align="right">Итого:</td>
					<td class="fullsum"></td>
				</tr>
				</tbody>
			</table>
			<?
		} else {
			?>
				<table>
					<tr>
						<td align="center">Нет отчетов</td>
					</tr>
				</table>
			<?
		}
		
		
		
	}
	
	
	function getClientAnalysis($list,$client) {
		$client_dd = $this->getUserByEmail($client['appl']);
		
		$query = "SELECT * FROM ts WHERE `owner`=".$client_dd['ID'];	
		
		if($list['cat'] != '0') {
			$query = $query. " AND `cat`='".$list["cat"]."'";
		}
		$info = $this->query($query);
		
		if(mysql_num_rows($info) > 0) { 
			?>
			<table class="table table-striped table-analysis">
				<thead>
					<tr>
						<th>Дата:</th>
						<th>Заявитель:</th>
						<th>Категория ТС:</th>
						<th>Стоимость:</th>
					</tr>
				</thead>
				<tbody>
			<?
			while ($i = mysql_fetch_array($info)):
			?>
				<? if(strtotime($i["ddate"])>0 AND strtotime($list["fromdate"]) > 0) { ?>
				<? if((strtotime($i["ddate"])>=strtotime($list["fromdate"])) AND (strtotime($i["ddate"])<=strtotime($list["todate"]))) { ?>
				<tr>
					<td><?echo $i["ddate"];?></td>
					<td><a href="/admin/?page=clients&act=view&ID=<?=$i["owner"]?>"><?echo $this->formatFIO($i);?></a></td>
					<td>
						<?switch ($i["cat"]):
							case 'M1': $cat = 'Категория A ('.$i["cat"].')'; break;
							case 'N1': $cat = 'Категория B ('.$i["cat"].')'; break;
							case 'N2':
							case 'N3': $cat = 'Категория C ('.$i["cat"].')'; break;
							case 'M2':
							case 'M3': $cat = 'Категория D ('.$i["cat"].')'; break;
							case 'O1':
							case 'O2':
							case 'O3':
							case 'O4': $cat = 'Категория E ('.$i["cat"].')'; break;
						endswitch;
						echo $cat;
						?>
					</td>
					<td class="cost">
						<? if(preg_match("/^[0-9]+$/", $i["cost"])) {
								echo $i["cost"]." P.";
						} else {
								echo " - ";
						} ?>
					</td>
				</tr>
				<? } } else {?>
				<? if(strtotime($i["ddate"])>=strtotime($list["fromdate"])) { ?>
				<tr>
					<td><?echo $i["ddate"];?></td>
					<td><a href="/admin/?page=clients&act=view&ID=<?=$i["owner"]?>"><?echo $this->formatFIO($i);?></a></td>
					<td>
						<?switch ($i["cat"]):
							case 'M1': $cat = 'Категория A ('.$i["cat"].')'; break;
							case 'N1': $cat = 'Категория B ('.$i["cat"].')'; break;
							case 'N2':
							case 'N3': $cat = 'Категория C ('.$i["cat"].')'; break;
							case 'M2':
							case 'M3': $cat = 'Категория D ('.$i["cat"].')'; break;
							case 'O1':
							case 'O2':
							case 'O3':
							case 'O4': $cat = 'Категория E ('.$i["cat"].')'; break;
						endswitch;
						echo $cat;
						?>
					</td>
					<td class="cost">
						<? if(preg_match("/^[0-9]+$/", $i["cost"])) {
								echo $i["cost"]." P.";
						} else {
								echo " - ";
						} ?>
					</td>
				</tr>
				<? } } ?>
			<?
			endwhile;
			?>
				<tr class="info">
					<td colspan="3" align="right">Итого:</td>
					<td class="fullsum"></td>
				</tr>
				</tbody>
			</table>
			<?
		} else {
			?>
				<table>
					<tr>
						<td align="center">Нет отчетов</td>
					</tr>
				</table>
			<?
		}
		
		
		
	}
}
?>