<?php
 require_once("db_config.php");
class Job {

 private $jobname="";
 private $loc="";
 private $descrip="";
 private $estcost="";
  private $sdate="";
   private $edate="";
   private $cid=null;
  private $jid=null;



public function __construct( $jname ,$loc, $descrip, $estcost, $sdate, $edate,$uid,$jid){
  $this->jobname = $jname;
  $this->loc = $loc;
  $this->descrip = $descrip;
  $this->estcost = $estcost;
  $this->sdate = $sdate;
  $this->edate = $edate;
  $this->cid = $uid;
  $this->jid = $jid;
}
 public static function createjob($db,$jname ,$loc, $descrip, $estcost, $sdate, $edate,$uid)
 {

     $query ="INSERT INTO job SET job_name='$jname', location='$loc', Discription='$descrip', Expected_Cost='$estcost' ,Start_Date='$sdate'  ,End_Date='$edate',uid='$uid'";


     $result = $db->query($query);
      if ($result)
      {
        $jid = $db->insert_id;
        $job = new Job($jname ,$loc, $descrip, $estcost, $sdate, $edate,$uid,$jid);
        $result = $job;

      }
      return $result;


 }

 public static function view_my_job($db,$uid)
 {
	 $query = "SELECT  `job_name`, `location`, `Discription`, `Expected_Cost`, `Start_Date`, `End_Date` FROM `job` WHERE uid='$uid'";
	 //$query = "SELECT * FROM job";
	 $result = $db->query($query) or die($db->error);
	//$result->execute();

		 ?>
		 <table class = "table table-hover">
		 <thead>
		 <tr>

		 <th>Job Name</th>
		 <th>Location</th>
		 <th>Description</th>
		 <th>Estimated Total Cost</th>
		 <th>Job Start Date</th>
		 <th>Job Expire Date</th>


		 </tr>
		 </thead>
		 <tbody>
		 <?php
//  $row = $qresult->fetch_assoc(); fetch(PDO::FETCH_ASSOC)

		 while($res = $result->fetch_assoc())
		 {
			 if($res!=0)
			 {
				 ?>

				 <div class="container-fluid">

						 <tr>

						 <td><?= $res['job_name']; ?> </td>
						 <td><?= $res['location']; ?> </td>
						 <td><?= $res['Discription']; ?> </td>
						 <td><?= $res['Expected_Cost']; ?> </td>
						 <td><?= $res['Start_Date']; ?> </td>
						 <td><?= $res['End_Date']; ?> </td>

						 </tr>
				 </div>

		 <?php
			 }
			 if($res==0)
			 {
				 return "Sorry No Records Found..";
			 }
		 }?>
		 </tbody>
		 </table>
		 <?php
 }

 public  static function view_all_job($db)
 {

	 $query = "SELECT * FROM job";
	 $result = $db->query($query) or die($db->error);
	//$result->execute();

		 ?>
		 <table class = "table table-hover">
		 <thead>
		 <tr>

		 <th>Job Name</th>
		 <th>Location</th>
		 <th>Job Expire Date</th>


		 </tr>
		 </thead>
		 <tbody>
		 <?php
//  $row = $qresult->fetch_assoc(); fetch(PDO::FETCH_ASSOC)
		 while($res = $result->fetch_assoc())
		 {

				 ?>

				 <div class="container-fluid">

						 <tr>

						 <td><?= $res['job_name']; ?> </td>
						 <td><?= $res['location']; ?> </td>

						 <td><?= $res['End_Date']; ?> </td>
						 <td><a href="jobdetail.php?jid=<?php echo $res['jid']; ?>" class="btn btn-info">Details</a></td>


						 </tr>
				 </div>

		 <?php
		 }?>
		 </tbody>
		 </table>
		 <?php
 }


 public static function find($db, $id){
   // search students table and locate record with id
   // get that record and create student object
   // return student object OR false if we cannot find it
   $result = false;
   $query = "SELECT * FROM job WHERE jid = $id";
     $result = $db->query($query) or die($db->error);
   if ($result){
     if ($result->num_rows == 1){
       $user_data = $result->fetch_assoc();

         $user = new Job($user_data['job_name'],$user_data['location'],$user_data['Discription'],$user_data['Expected_Cost'],$user_data['Start_Date'],$user_data['End_Date'],$user_data['uid'],$user_data['jid']);

       $result = $user;
     }
   }
   return $result;
 }




 // ------- getter methods ----------
 public function getJObName(){
   return $this->jobname;
 }

 public function getLoc(){
   return $this->loc;
 }

 public function getDescrip(){
   return $this->descrip;
 }

 public function getEcost(){
   return $this->estcost;
 }

 public function getSdate(){
   return $this->sdate;
 }
 public function getEdate(){
   return $this->edate;
 }
 public function getCid(){
   return $this->cid;
 }
 public function getJid(){
   return $this->jid;
 }



}

?>
