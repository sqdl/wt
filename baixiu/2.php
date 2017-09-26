
<?php
	require '../config.php';
	//封装session
	function checkLogin(){
		session_start();
		if(!isset($_SESSION['user_info'])){
		   header('Location:/admin/login.php');
		   exit;
		}
	}

	
	function connect(){
		$connection=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD);
		if(!$connection){
			die('数据库连接失败');
		}
		mysqli_select_db($connection,DB_NAME);
		mysqli_set_charset($connection,DB_CHARSET);
		return $connection;
	}

	function query($sql){
		$connection=connect();
		$result=mysqli_query($connection,$sql);

		$rows=fetch($result);
		return $rows;
	}

	function insert($table,$arr){
		$connection=connect();

		$keys=array_keys($arr);
		$values=array_values($arr);

		$sql='INSERT INTO '.$table.'('.implode(',',$keys).') VALUES("'.implode('","', $values).'")';

		$result=mysqli_query($connection,$sql);
		return $result;
	}

	function fetch($result){
		$rows=array();
		while($row=mysqli_fetch_assoc($result)){
			$rows[]=$row;
		}
		return $rows;
	}

	//删除
	function delete($sql){
		$connection=connect();
		$result=mysqli_query($connection,$sql);

		return $result;
	}

	//修改
	function update($table,$arr,$id){
		$connection=connect();
		$str='';

		 foreach($arr as $key=>$val) {
            $str .= $key . '=' . '"' . $val . '", ';
        }

		  $str = substr($str, 0, -2);

		$sql = 'UPDATE ' . $table . ' SET ' . $str . ' WHERE id=' . $id;

		$result=mysqli_query($connection,$sql);
		return $result;
	}
