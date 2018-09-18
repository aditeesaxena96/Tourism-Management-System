<?php
interface user                                   //interface
{
    public function view();
    public function insert($pid,$useremail,$fromdate,$todate,$status);
    public function fetchpackdetails($pid);
    public function enquiry($fname,$email,$mobile,$subject,$description);
    public function signup($fname,$mobile,$email,$pass);
    public function signin($email,$password);
    public function profile($useremail);
    public function tour_action($email,$bid);
    public function tour_history($uemail);
    public function email($email);
}
class Database implements user
{
    private $connection;
    function __construct()
    {
	    $this->connect_db();
    }
 
    public function connect_db()
    {
		$this->connection = mysqli_connect('localhost', 'root', '', 'tms');
        if(mysqli_connect_error())
        {
			die("Database Connection Failed" . mysqli_connect_error() . mysqli_connect_errno());
		}
    }

      public function view()
    {
       $sql = "select * from tbltourpackages;";
       //print_r($sql);die;
       if ($row=mysqli_query($this->connection, $sql))
       {
           return $row;  
       }
       else
       {
           return false;
       }
   }

   public function insert($pid,$useremail,$fromdate,$todate,$status)
   {
    
     $sql="INSERT INTO `tblbooking`(`PackageId`, `UserEmail`, `FromDate`, `ToDate`, `status`) 
         VALUES ($pid,'$useremail','$fromdate','$todate',$status)";
        
  
       if (mysqli_query($this->connection, $sql))
       {
           return true;  
       }
       else
       {
           return false;
       }
    }

    public function fetchpackdetails($pid)
    {
        $sql = "SELECT * from tbltourpackages where PackageId='$pid'";
        
        $res=mysqli_query($this->connection, $sql);
        
        if (mysqli_num_rows($res)>0)
        {
            return $res;  
        }
        else
        {
            return false;
        } 
    }

    public function enquiry($fname,$email,$mobile,$subject,$description)
    {
        $sql="INSERT INTO `tblenquiry`(`FullName`, `EmailId`, `MobileNumber`, `Subject`, `Description`)
         VALUES ('$fname','$email','$mobile','$subject','$description')";
        
        if (mysqli_query($this->connection, $sql))
        {
            return true;  
        }
        else
        {
            return false;
        }
    }

    public function signup($fname,$mobile,$email,$pass)
    {
        $sql="INSERT INTO `tblusers`(`FullName`, `MobileNumber`, `EmailId`, `Password`) 
        VALUES ('$fname','$mobile','$email','$pass')";
        if (mysqli_query($this->connection, $sql))
        {
            return true;  
        }
        else
        {
            return false;
        }
    }

    public function signin($email,$password)
    {
        $sql="select EmailId , Password from tblusers where `EmailId` like '$email' AND `password` = '$password'";
        
        if (mysqli_query($this->connection, $sql))
        {
            return true;  
        }
        else
        {
            return false;
        }
    }


    public function profile($useremail)
    {
        $sql = "SELECT * from tblusers where EmailId like '$useremail'";
           
        
        $res=mysqli_query($this->connection, $sql);
        
        if (mysqli_num_rows($res)>0)
        {
            return $res;  
        }
        else
        {
            return false;
        } 
    }

    public function tour_action($email,$bid)
    {
        $sql ="SELECT FromDate FROM tblbooking WHERE UserEmail like '$email' and BookingId=$bid";
        $res=mysqli_query($this->connection, $sql);
        
        if (mysqli_num_rows($res)>0)
        {
            return $res;  
        }
        else
        {
            return false;
        } 
        
    }

    public function tour_history($uemail)
    {
        $sql = "SELECT tblbooking.BookingId as bookid,tblbooking.PackageId as pkgid,tbltourpackages.PackageName as packagename,
                tblbooking.FromDate as fromdate,tblbooking.ToDate as todate,tblbooking.status as status,
                tblbooking.RegDate as regdate,tblbooking.CancelledBy as cancelby,tblbooking.UpdationDate as upddate
                from tblbooking join tbltourpackages on tbltourpackages.PackageId=tblbooking.PackageId where UserEmail like '$uemail'";
                $res=mysqli_query($this->connection, $sql);
        if (mysqli_num_rows($res)>0)
        {
            return $res;  
        }
        else
        {
            return false;
        } 
    }

    public function email($email)
    {
        $sql ="SELECT EmailId FROM tblusers WHERE EmailId='$email'";  
        if (mysqli_query($this->connection, $sql))
        {
            return true;  
        }
        else
        {
            return false;
        }
    }

}
$database = new Database();
$database->connect_db();
?>

