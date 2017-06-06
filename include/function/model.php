<?php

//function to get data from user data base
function getData(){
	global $con;
	$stmt=$con->prepare("SELECT * FROM user where u_state = 1");
	$stmt->execute();
	$record = $stmt->fetchAll();
	return $record;
}

// get recoreds from user table where id = sme thin

function getUser($id){
	global $con;
	$stmt=$con->prepare("SELECT * FROM user where u_id = $id");
	$stmt->execute();
	$record = $stmt->fetchAll();
	return $record;
}
//add data to doctors tables
function addDoctor($name,$spa){

		global $con;
		$stmt = $con->prepare("INSERT INTO doctors(d_name , d_specilist ) VALUES(?,?)");
		$stmt->execute(array($name, $spa));
		if($stmt->rowCount() >0){$erroe=0;}
		else {$erroe=1;}
		return $erroe;

}
//get all data from dpoctor table
function getDoc(){
		global $con;
		$stmt=$con->prepare("SELECT * FROM doctors ORDER BY d_id DESC");
		$stmt->execute();
		$record = $stmt->fetchAll();
		return $record;
}

// add datato patient table
function addpatient($name,$age,$gender,$email,$phone,$address,$doctor,$user){
		global $con;
		$stmt = $con->prepare("INSERT INTO patient(p_name , p_age , p_gender , p_email ,p_phoneNumber,p_adress,p_date, d_id , u_id) VALUES(?,?,?,?,?,?,now(),?,?)");
		$stmt->execute(array($name, $age,$gender,$email,$phone,$address,$doctor,$user));
		if($stmt->rowCount() >0){$erroe=0;}
		else {$erroe=1;}
		return $erroe;
						}
//get data from patient according to user who insert them\

function patientable($id){
		global $con;
		$stmt=$con->prepare("SELECT * FROM patient WHERE u_id = ? ORDER BY p_id DESC LIMIT 10");
		$stmt->execute(array($id));
		$record = $stmt->fetchAll();
		return $record;



}

//get data from patient where id = ?
function getpatient($id){
		global $con;
		$stmt=$con->prepare("SELECT * FROM patient WHERE p_id = ?");
		$stmt->execute(array($id));
		$record = $stmt->fetchAll();
		return $record;


}

//get doctor for patient page by id =??\

function getdoctor($id){
		global $con;
		$stmt=$con->prepare("SELECT d_name FROM doctors where d_id =?");
		$stmt->execute(array($id));
		$record = $stmt->fetchAll();
		return $record;


}
//get bill for each patient
function bill($bid){

	global $con;
		$stmt=$con->prepare("SELECT * FROM bill where p_id=? AND b_status != 2 ORDER BY b_id DESC ");
		$stmt->execute(array($bid));
		$record = $stmt->fetchAll();
		return $record;
}
function billind($bid){

	global $con;
		$stmt=$con->prepare("SELECT * FROM bill where b_id=? ORDER BY b_id DESC ");
		$stmt->execute(array($bid));
		$record = $stmt->fetchAll();
		return $record;
}
// addbilll to database
function addbill($billN,$id){
         global $con;
		$stmt = $con->prepare("INSERT INTO bill(b_number ,b_date, p_id) VALUES(?,now(),?)");
		$stmt->execute(array($billN,$id));
		if($stmt->rowCount() >0){$erroe=0;}
		else {$erroe=1;}
		return $erroe;

}
// get last bill number
function biilnumb(){
		global $con;
		$stmt=$con->prepare("SELECT b_number FROM bill  ORDER BY b_id DESC LIMIT 1");
		$stmt->execute();
		$record = $stmt->fetchAll();
		return $record;

}
//????????!!!!!!!!!!!!
function emptyBill(){

	    global $con;
		$stmt = $con->prepare("INSERT INTO bill(b_number , p_id) VALUES(0,0)");
		$stmt->execute();

}

// 	get patient and doctor by join query

function getPatientDoctor($id){
		global $con;
		$stmt=$con->prepare("SELECT patient.p_id,patient.p_name ,patient.p_age , patient.p_gender , patient.p_email , patient.p_phoneNumber ,patient.p_adress,doctors.d_name
                   FROM `patient`
                   join doctors
				   on patient.d_id = doctors.d_id
				   Where p_id = ?");
		$stmt->execute(array($id));
		$record = $stmt->fetchAll();
		return $record;
}
// get test group from database
function testGroup(){
		global $con;
		$stmt=$con->prepare("SELECT tc_id ,tc_name FROM test_group ");
		$stmt->execute();
		$record = $stmt->fetchAll();
		return $record;

}
function groupid($id){
		global $con;
		$stmt=$con->prepare("SELECT tc_id ,tc_name FROM test_group WHERE tc_id=? ");
		$stmt->execute(array($id));
		$record = $stmt->fetchAll();
		return $record;

}

// get test according to test group v2.0
function test($id){

	global $con;
		$stmt=$con->prepare("SELECT * FROM tests WHERE tc_id =? ");
		$stmt->execute(array($id));
		$record = $stmt->fetchAll();
		return $record;
}
//gettest all
function testAll(){

	global $con;
		$stmt=$con->prepare("SELECT * FROM tests ");
		$stmt->execute();
		$record = $stmt->fetchAll();
		return $record;
}
//add  test for bill
function addTest($bid,$tid,$uid){
		global $con;
		$stmt = $con->prepare("INSERT INTO bill_test(b_id ,t_id,u_id) VALUES(?,?,?)");
		$stmt->execute(array($bid,$tid,$uid));

}
//get data from bill_test to insert result
function testResult($pid){
			global $con;
		$stmt=$con->prepare("SELECT tests.t_id , tests.t_name, tests.t_price , bill_test.result
					from bill_test
					join tests
					on bill_test.t_id = tests.t_id
					Where b_id =?");
		$stmt->execute(array($pid));
		$record = $stmt->fetchAll();
		return $record;

}

// add result hahahahah
function editTest($result,$bid,$tid){

	    global $con;
		$stmt = $con->prepare("UPDATE bill_test SET result = ? WHERE b_id =? AND t_id =?");
		$stmt->execute(array($result,$bid,$tid));
}
//delete test from bill
function deleteTestBill($bid,$tid){
		 global $con;
		$stmt = $con->prepare("DELETE FROM `bill_test`  WHERE b_id =? AND t_id =?");
		$stmt->execute(array($bid,$tid));

}

//get doctors
function getDoct(){
		global $con;
		$stmt=$con->prepare("SELECT * FROM doctors ");
		$stmt->execute();
		$record = $stmt->fetchAll();
		return $record;
}
//count number of patient for each  doctor
function numOfPatient($id){
		global $con;
		$stmt = $con->prepare("SELECT COUNT(p_id) AS Num FROM patient where d_id =?");
		$stmt->execute(array($id));
		$record = $stmt->fetchAll();
		return $record;

}
//delete at all any thin
function delete($table,$where,$id){

		global $con;
		$stmt = $con->prepare("DELETE FROM $table  WHERE  $where = ?");

		$stmt->execute(array($id));

}
//get doctor by id
function getDoctorD($id){
		global $con;
		$stmt=$con->prepare("SELECT * FROM doctors where d_id =?");
		$stmt->execute(array($id));
		$record = $stmt->fetchAll();
		return $record;


}
//edit doctor infos
function editDoctor($id,$name,$spas){
   global $con;
		$stmt = $con->prepare("UPDATE doctors SET d_name = ?  ,d_specilist =? WHERE d_id =? ");
		$stmt->execute(array($name,$spas,$id));

}
//get data from patients

function getPatients(){
	   global $con;
		$stmt=$con->prepare("SELECT * FROM patient ORDER BY p_id DESC");
		$stmt->execute();
		$record = $stmt->fetchAll();
		return $record;
}
function editPatient($name,$age,$email,$adres,$gender,$phone,$id){

	global $con;
	$stmt = $con->prepare('UPDATE patient SET p_name =? ,p_age =? , p_gender =? ,p_email=? ,p_phoneNumber=? , p_adress=? WHERE p_id =?');
	$stmt->execute(array($name,$age,$gender,$email,$phone,$adres,$id));
}
//edit user
function editUser($name,$email,$phone,$age,$address,$info,$id){

	global $con;
	$stmt = $con->prepare('UPDATE user SET name =? ,email =? , phone =? ,address=? , age= ? ,info=? WHERE u_id =?');
	$stmt->execute(array($name,$email,$phone,$address,$age,$info,$id));

}

//add labrotary to database
function addLab($lab){

		global $con;
		$stmt = $con->prepare("INSERT INTO lab_type(l_name) VALUES(?)");
		$stmt->execute(array($lab));

}

// get data from lab table
function getLab(){
	global $con;
	$stmt=$con->prepare("SELECT * FROM lab_type ");
	$stmt->execute();
	$record = $stmt->fetchAll();
	return $record;


}
function addGroup($name,$lab){
		global $con;
		$stmt = $con->prepare("INSERT INTO test_group(tc_name,l_id) VALUES(?,?)");
		$stmt->execute(array($name,$lab));

}

function getGroup(){
	global $con;
	$stmt=$con->prepare("SELECT * FROM test_group ");
	$stmt->execute();
	$record = $stmt->fetchAll();
	return $record;

}
//add test
function addTestT($name,$acr,$price,$norma,$unit,$group){
		global $con;
		$stmt = $con->prepare("INSERT INTO tests(t_name,t_acrynom,t_price,t_normalvalue,units,tc_id) VALUES(?,?,?,?,?,?)");
		$stmt->execute(array($name,$acr,$price,$norma,$unit,$group));

}

// get test by geroup id
function testGroup2($id){
	global $con;
	$stmt=$con->prepare("SELECT * FROM tests WHERE tc_id =? ");
	$stmt->execute(array($id));
	$record = $stmt->fetchAll();
	return $record;

}
//get tests by id
function getTest($id){
		global $con;
		$stmt=$con->prepare("SELECT * FROM tests WHERE t_id =? ");
		$stmt->execute(array($id));
		$record = $stmt->fetchAll();
		return $record;


}
//edit test
function editTestT($name,$acr,$price,$norma,$unit,$group,$id){
	global $con;
	$stmt = $con->prepare("UPDATE tests SET  t_name=?,t_acrynom=?,t_price=?,t_normalvalue=?,units=?,tc_id =? WHERE t_id=? ");
		$stmt->execute(array($name,$acr,$price,$norma,$unit,$group,$id));


}
function printInfo($bid){
		global $con;
		$stmt=$con->prepare("SELECT * FROM bill_test
			WHERE   b_id =? ");
		$stmt->execute(array($bid));
		$record = $stmt->fetchAll();
		return $record;


}


//get bill for paid info
function billl($bid){

	global $con;
		$stmt=$con->prepare("SELECT * FROM bill where b_id=?");
		$stmt->execute(array($bid));
		$record = $stmt->fetchAll();
		return $record;
}
//update stuffs
function updatePaid($paid,$sum,$id){
			global $con;
	$stmt = $con->prepare('UPDATE bill SET b_paid_amount=?,	b_total_amount=? WHERE b_id =?');
	$stmt->execute(array($paid,$sum,$id));



	}

	//get patients for pagination
	function getbillPagination($limit,$num,$id){
		global $con;
		$stmt=$con->prepare("SELECT * FROM bill WHERE p_id = ? And b_status != 2 ORDER BY b_id DESC  LIMIT $limit,$num " );
		$stmt->execute(array($id));
		$record = $stmt->fetchAll();
		return $record;

	}

	//add doctor


	function adddoctorr($name,$spas,$adres,$phone,$email){

		global $con;
		$stmt = $con->prepare("INSERT INTO doctors(d_name , d_specilist ,d_adres,d_phone,d_email) VALUES(?,?,?,?,?)");
		$stmt->execute(array($name, $spas,$adres,$phone,$email));
		if($stmt->rowCount() >0){$erroe=0;}
		else {$erroe=1;}
		return $erroe;
	}

	//edit doctor v2.0
	function editDoctorr($name,$spas,$phone,$mail,$addres,$id){
			 global $con;
		$stmt = $con->prepare("UPDATE doctors SET d_name = ?  ,d_specilist =? ,d_adres =? , d_phone=? , d_email=? WHERE d_id =? ");
		$stmt->execute(array($name,$spas,$addres,$phone,$mail,$id));

	}
	//select data from bill test
	function billTestResult($id){
				global $con;
		$stmt=$con->prepare("
			SELECT bill_test.result
                   FROM bill_test
                   right join bill
				   on  bill_test.b_id = bill.b_id
				   Where p_id = ?");
		$stmt->execute(array($id));
		$record = $stmt->fetchAll();
		return $record;

	}

	//check empty bill
	function emptyBilll($id){
		global $con;
$stmt=$con->prepare("sELECT bill_test.result 
								 FROM bill_test
								 right join bill
				 on  bill_test.b_id = bill.b_id
				 Where bill.b_id = ?  ");
$stmt->execute(array($id));
$record = $stmt->fetchAll();
return $record;

	}

// insert record
function addRecord($id){
	global $con;
	$stmt = $con->prepare("INSERT INTO record(b_id) VALUES(?)");
	$stmt->execute(array($id));
	if($stmt->rowCount() >0){$erroe = 1;}
	else {$erroe = 0;}
	return $erroe;
}

function getRecord($id){

	global $con;
	$stmt=$con->prepare("SELECT * FROM record where b_id=?");
	$stmt->execute(array($id));
	$record = $stmt->fetchAll();
	return $record;

}

function editRecord($result,$id){
	global $con;
$stmt = $con->prepare("UPDATE record SET b_record = ? WHERE b_id =? ");
$stmt->execute(array($result,$id));


}

function delRecord($b_id){
	global $con;
 $stmt = $con->prepare("DELETE FROM `record`  WHERE b_id =?");
 $stmt->execute(array($b_id));


		}

		function getPaidDay(){
			global $con;
			$stmt = $con->prepare("SELECT sum(b_paid_amount) as sum FROM `bill` 
				WHERE DAY(CURRENT_DATE()) = DAY(b_date) ");
			$stmt->execute();
			$record =	$stmt->fetchAll();
			return $record;
		}
		function getPaidMonth(){
			global $con;
			$stmt = $con->prepare("SELECT sum(b_paid_amount) as sum FROM `bill` 
				WHERE MONTH(CURRENT_DATE()) = MONTH(b_date) ");
			$stmt->execute();
			$record =	$stmt->fetchAll();
			return $record;
		}
		function getPaidWeek(){
			global $con;
			$stmt = $con->prepare("SELECT sum(b_paid_amount) as sum FROM `bill`
			 WHERE WEEKOFYEAR(CURRENT_DATE()) = WEEKOFYEAR(b_date) ");
			$stmt->execute();
			$record =	$stmt->fetchAll();
			return $record;
		}
		function getPatientDay(){
			global $con;
			$stmt = $con->prepare("SELECT count(p_id) as num FROM patient where DAY(CURRENT_DATE()) = DAY(p_date) ");
			$stmt->execute();
			$record =	$stmt->fetchAll();
			return $record;
		}
		function getPatientWeek(){
			global $con;
			$stmt = $con->prepare("SELECT count(p_id) as num FROM patient where WEEKOFYEAR(CURRENT_DATE()) = WEEKOFYEAR(p_date) ");
			$stmt->execute();
			$record =	$stmt->fetchAll();
			return $record;
		}
		function getPatientMonth(){
			global $con;
			$stmt = $con->prepare("SELECT count(p_id) as num FROM patient where MONTH(CURRENT_DATE()) = MONTH(p_date) ");
			$stmt->execute();
			$record =	$stmt->fetchAll();
			return $record;
		}

		function testStat($id,$date){
			global $con;
			$stmt = $con->prepare("SELECT count(*) AS cons FROM `bill_test` WHERE t_id=? AND   MONTH(date) = MONTH(?)");
			$stmt->execute(array($id,$date));
			$record =	$stmt->fetchAll();
			return $record;

		}

		function inserMAt($name,$num,$unit,$price){
			global $con;
			$stmt = $con->prepare("INSERT INTO material(m_name , m_num, m_unit , price,m_date ) VALUES(?,?,?,?,now())");
			$stmt->execute(array($name,$num,$unit,$price));

		}
		function getMat(){
			global $con;
			$stmt=$con->prepare("SELECT * FROM material WHERE MONTH(m_date) = MONTH(now()) ORDER BY m_id DESC");
			$stmt->execute();
			$record = $stmt->fetchAll();
			return $record;
		}
		function deleteMat($id){
				global $con;
			$stmt=$con->prepare("DELETE  From material WHERE m_id=?");
			$stmt->execute(array($id));

		}

//get info for specific test chossen in bill page 
		function getTestBill($bid,$tid){

			global $con;
			$stmt=	$con->prepare("SELECT result FROM bill_test WHERE b_id =? AND t_id=?");
			$stmt->execute(array($bid,$tid));
			$record = $stmt->fetchAll();
			return $record;
		}

		//get number of patient for every doctor
		function getPatientDoc($did){
				global $con;
			$stmt=	$con->prepare("SELECT count(p_name) as con FROM `patient` WHERE d_id=? AND MONTH(CURRENT_DATE())= MONTH(p_date)");
			$stmt->execute(array($did));
			$record = $stmt->fetchAll();
			return $record;

		}

		function events(){
			global $con;
			$stmt=	$con->prepare("SELECT * FROM events ");
			$stmt->execute();
			$record = $stmt->fetchAll();
			return $record;

		}
		function addEvents($title,$color,$start,$end){
						global $con;
		$stmt = $con->prepare("INSERT INTO events(title,color,start,end) VALUES(?,?,?,?)");
		$stmt->execute(array($title,$color,$start,$end));

			
		}


function pending($id){

	 global $con;
		$stmt = $con->prepare("UPDATE bill SET b_status= 1 WHERE b_id =? ");
		$stmt->execute(array($id));


}

function finished($id){

		 global $con;
		$stmt = $con->prepare("UPDATE bill SET b_status= 2 WHERE b_id =? ");
		$stmt->execute(array($id));
}


function pendingstate(){
		global $con;
		$stmt = $con->prepare("SELECT patient.p_id,patient.p_name , bill.b_id , bill.b_number, bill.b_status , bill.b_date
                   FROM `patient`
                   join bill
				   on bill.p_id = patient.p_id
				   Where bill.b_status 
				   != 2 And bill.b_status != 1");
		$stmt->execute();
		$record = $stmt->fetchAll();
		return $record;

}

function finshedstate(){

		global $con;
		$stmt = $con->prepare("SELECT patient.p_id,patient.p_name , bill.b_id , bill.b_number, bill.b_status , bill.b_date
                   FROM `patient`
                   join bill
				   on bill.p_id = patient.p_id
				   Where bill.b_status 
				   = 1");
		$stmt->execute();
		$record = $stmt->fetchAll();
		return $record;
}

function paidDoc($id){
		global $con;
		$stmt = $con->prepare("SELECT patient.d_id , bill.b_paid_amount
                   FROM `patient`
                   join bill
				   on bill.p_id = patient.p_id
				   Where patient.d_id=?");
		$stmt->execute();
		$record = $stmt->fetchAll();
		return $record;

}












