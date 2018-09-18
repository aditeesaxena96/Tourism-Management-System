<?php
abstract class Admin                                     //Abstract Class
{
    abstract protected function login_admin($uname,$pass);
    abstract protected function create_package($pname,$ptype,$plocation,$pprice,$pfeatures,$pdetails,$pimage);
    abstract protected function manage_users();
    abstract protected function manage_booking();
    abstract protected function manage_enquiry();
    abstract protected function manage_package();
}
class Database extends Admin
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

    
    public function login_admin($uname,$pass)
    {
        $sql ="SELECT UserName,Password FROM admin WHERE UserName='$uname' and Password='$pass'";
        $res=mysqli_query($this->connection, $sql);
        
        if (mysqli_num_rows($res)>0)
        {
            return true;  
        }
        else
        {
            return false;
        } 
    }

    public function create_package($pname,$ptype,$plocation,$pprice,$pfeatures,$pdetails,$pimage)
    {
        $sql="INSERT INTO TblTourPackages(PackageName,PackageType,PackageLocation,PackagePrice,PackageFeatures,PackageImage) 
             VALUES('$pname','$ptype','$plocation','$pprice','$pfeatures','$pimage')";
        if (mysqli_query($this->connection, $sql))
        {
            return true;  
        }
        else
        {
            return false;
        }
    }

    public function manage_users()
    {
        $sql = "SELECT * from tblusers";
      
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

    public function manage_booking()
    {
        $sql = "SELECT tblbooking.BookingId as bookid,tblusers.FullName as fname,tblusers.MobileNumber as mnumber,
                tblusers.EmailId as email,tbltourpackages.PackageName as pckname,tblbooking.PackageId as pid,
                tblbooking.FromDate as fdate,tblbooking.ToDate as tdate,tblbooking.status as status,tblbooking.CancelledBy as cancelby
                ,tblbooking.UpdationDate as upddate from tblusers join  tblbooking on  tblbooking.UserEmail=tblusers.EmailId 
                join tbltourpackages on tbltourpackages.PackageId=tblbooking.PackageId";
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


    public function manage_enquiry()
    {
        $sql = "SELECT * from tblenquiry";
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

    public function manage_package()
    {
        $sql = "SELECT * from TblTourPackages";
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
}
$database = new Database();
$database->connect_db();
?>