<?php 
class taikhoanapi{
	private $conn;

	public $id;
	public $ten;
	public $username;
	public $password;
	public $email;
	public $phanquyen;

	public function __construct($db){
		$this->conn = $db;
	}

	public function read(){
		$query = "SELECT * FROM taikhoan";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}

	// public function readbypage() {
	//     $this->tung_trang = ($this->trang - 1) * $this->sp_tungtrang;

	//     // Truy vấn để lấy tổng số bản ghi
	//     $countQuery = "SELECT COUNT(*) as total FROM taikhoan WHERE hienthi=:hienthi";

	//     if (!empty($this->search)) {
	//         $countQuery .= " AND tennd LIKE :search";
	//     }

	//     $stmtCount = $this->conn->prepare($countQuery);
	//     $stmtCount->bindParam(':hienthi', $this->hienthi, PDO::PARAM_INT);

	//     if (!empty($this->search)) {
	//         $searchParam = "%" . $this->search . "%";
	//         $stmtCount->bindParam(':search', $searchParam, PDO::PARAM_STR);
	//     }

	//     $stmtCount->execute();
	//     $totalResult = $stmtCount->fetch(PDO::FETCH_ASSOC);
	//     $total = $totalResult['total'];

	//     // Truy vấn chính với giới hạn LIMIT
	//     $query = "SELECT * FROM taikhoan WHERE hienthi=:hienthi";

	//     if (!empty($this->search)) {
	//         $query .= " AND tennd LIKE :search";
	//     }

	//     $query .= " LIMIT :tungtrang, :sp_tungtrang";

	//     $stmt = $this->conn->prepare($query);

	//     $stmt->bindParam(':tungtrang', $this->tung_trang, PDO::PARAM_INT);
	//     $stmt->bindParam(':sp_tungtrang', $this->sp_tungtrang, PDO::PARAM_INT);
	//     $stmt->bindParam(':hienthi', $this->hienthi, PDO::PARAM_INT);

	//     if (!empty($this->search)) {
	//         $searchParam = "%" . $this->search . "%";
	//         $stmt->bindParam(':search', $searchParam, PDO::PARAM_STR);
	//     }

	//     $stmt->execute();

	//     return array(
	//         'total' => $total,
	//         'data' => $stmt->fetchAll(PDO::FETCH_ASSOC)
	//     );
	// }

	public function show(){
		$query = "SELECT * FROM taikhoan where id=? limit 1";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id);
		$stmt->execute();
		

		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->id = $row['id'];	
		$this->ten = $row['ten'];
		$this->username = $row['username'];
		$this->password = $row['password'];
		$this->email = $row['email'];
		$this->phanquyen = $row['phanquyen'];
	}

	public function create(){
		$query = "INSERT INTO taikhoan SET ten=:ten, username=:username, password=:password,email=:email, phanquyen=:phanquyen";
		$stmt = $this->conn->prepare($query);

		$this->ten = $this->ten;
		$this->username = $this->username;
		$this->password = $this->password;
		$this->email = $this->email;
		$this->phanquyen = $this->phanquyen;
		$this->password = md5($this->password);

		$stmt->bindParam(':ten',$this->ten);
		$stmt->bindParam(':username',$this->username);
		$stmt->bindParam(':password',$this->password);
		$stmt->bindParam(':email',$this->email);
		$stmt->bindParam(':phanquyen',$this->phanquyen);
		if($stmt->execute()){
			return true;
		}
		printf("Error %s.\n" ,$stmt->error);
		return false;
	}

	public function update(){
		$query = "UPDATE taikhoan SET ten=:ten, username=:username, email=:email, phanquyen=:phanquyen";

		if (isset($this->password) && $this->password != null) {
	        $query .= ", password=:password";
	    }

	    $query .= " WHERE id=:id";

		$stmt = $this->conn->prepare($query);

		$this->ten= $this->ten;
		$this->username = $this->username;		
		$this->email = $this->email;
		$this->phanquyen = $this->phanquyen;
		$this->id = $this->id;		

		$stmt->bindParam(':ten',$this->ten);
		$stmt->bindParam(':username',$this->username);		
		$stmt->bindParam(':email',$this->email);
		$stmt->bindParam(':phanquyen',$this->phanquyen);
		$stmt->bindParam(':id',$this->id);
		if (isset($this->password) && $this->password != null) {
	        $this->password = $this->password;
	        $this->password = md5($this->password);
	        $stmt->bindParam(':password',$this->password);
	    }
		if($stmt->execute()){
			return true;
		}
		printf("Error %s.\n" ,$stmt->error);
		return false;
	}

	public function delete(){
		$query = "DELETE FROM taikhoan 
		WHERE id=:id";
		$stmt = $this->conn->prepare($query);

		$this->id = htmlspecialchars(strip_tags($this->id));

		$stmt->bindParam(':id',$this->id);
		if($stmt->execute()){
			return true;
		}
		printf("Error %s.\n" ,$stmt->error);
		return false;
	}
	// public function updatestatus(){
	// 	$query = "UPDATE taikhoan SET hienthi=:hienthi WHERE id=:id";
	// 	$stmt = $this->conn->prepare($query);

	// 	$this->hienthi = $this->hienthi;
	// 	$this->id = $this->id;


	// 	$stmt->bindParam(':hienthi',$this->hienthi);
	// 	$stmt->bindParam(':id',$this->id);
	// 	if($stmt->execute()){
	// 		return true;
	// 	}
	// 	printf("Error %s.\n" ,$stmt->error);
	// 	return false;
	// }
	// public function changepassword(){
	// 	$query = "UPDATE taikhoan SET password=:password WHERE id=:id";

	// 	$stmt = $this->conn->prepare($query);

	// 	$this->password = $this->password;
	// 	$this->id = $this->id;		

	// 	$this->password = md5($this->password);

	//     $stmt->bindParam(':password',$this->password);
	// 	$stmt->bindParam(':id',$this->id);

	// 	if($stmt->execute()){
	// 		return true;
	// 	}
	// 	printf("Error %s.\n" ,$stmt->error);
	// 	return false;
	// }


}	
 ?>
