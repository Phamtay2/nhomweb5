<?php 
class danhmucapi{
	private $conn;

	public $id;
	public $tendm;
	public $hienthi;
	public $uutien;
	public $ghichu;
	public $trang;
	public $tung_trang;
	public $sp_tungtrang;

	public function __construct($db){
		$this->conn = $db;
	}

	public function read(){
		$query = "SELECT * FROM danhmuc";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}

	// public function readbypage() {
	//     $this->tung_trang = ($this->trang - 1) * $this->sp_tungtrang;

	//     // Truy vấn để lấy tổng số bản ghi
	//     $countQuery = "SELECT COUNT(*) as total FROM danhmuc WHERE kieuhienthi = '1' AND hienthi=:hienthi";

	//     if (!empty($this->search)) {
	//         $countQuery .= " AND tendm LIKE :search";
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
	//     $query = "SELECT * FROM danhmuc WHERE kieuhienthi = '1' AND hienthi=:hienthi";

	//     if (!empty($this->search)) {
	//         $query .= " AND tendm LIKE :search";
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
		$query = "SELECT * FROM danhmuc where id=? limit 1";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id);
		$stmt->execute();
		

		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->id = $row['id'];	
		$this->tendm = $row['tendm'];
		$this->hienthi = $row['hienthi'];
		$this->uutien = $row['uutien'];
		$this->ghichu = $row['ghichu'];
	}

	public function create(){
		$query = "INSERT INTO danhmuc SET tendm=:tendm, hienthi=:hienthi, uutien=:uutien, ghichu=:ghichu";
		$stmt = $this->conn->prepare($query);

		$this->tendm = $this->tendm;
		$this->hienthi = $this->hienthi;
		$this->uutien = $this->uutien;
		$this->ghichu = $this->ghichu;

		$stmt->bindParam(':tendm',$this->tendm);
		$stmt->bindParam(':hienthi',$this->hienthi);
		$stmt->bindParam(':uutien',$this->uutien);
		$stmt->bindParam(':ghichu',$this->ghichu);
		if($stmt->execute()){
			return true;
		}
		printf("Error %s.\n" ,$stmt->error);
		return false;
	}

	public function update(){
		$query = "UPDATE danhmuc SET tendm=:tendm, hienthi=:hienthi, uutien=:uutien, ghichu=:ghichu WHERE id=:id";
		$stmt = $this->conn->prepare($query);

		$this->tendm = $this->tendm;
		$this->hienthi = $this->hienthi;
		$this->uutien = $this->uutien;
		$this->ghichu = $this->ghichu;
		$this->id = $this->id;


		$stmt->bindParam(':tendm',$this->tendm);
		$stmt->bindParam(':hienthi',$this->hienthi);
		$stmt->bindParam(':uutien',$this->uutien);
		$stmt->bindParam(':ghichu',$this->ghichu);
		$stmt->bindParam(':id',$this->id);
		if($stmt->execute()){
			return true;
		}
		printf("Error %s.\n" ,$stmt->error);
		return false;
	}

	public function delete(){
		$query = "DELETE FROM danhmuc 
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
	public function updatestatus(){
		$query = "UPDATE danhmuc SET hienthi=:hienthi WHERE id=:id";
		$stmt = $this->conn->prepare($query);

		$this->hienthi = $this->hienthi;
		$this->id = $this->id;


		$stmt->bindParam(':hienthi',$this->hienthi);
		$stmt->bindParam(':id',$this->id);
		if($stmt->execute()){
			return true;
		}
		printf("Error %s.\n" ,$stmt->error);
		return false;
	}


}	
 ?>
