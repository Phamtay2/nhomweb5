<?php 
class productapi{
	private $conn;

	public $masp;
	public $id;
	public $tensp;	
	public $danhmuc;
	public $gianhap;
	public $giaban;
	public $giakm;	
	public $hienthi;
	public $soluong;
	public $mota;
	
	public function __construct($db){
		$this->conn = $db;
	}

	public function read(){
		$query = "SELECT * FROM sanpham";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}

	// public function readbypage() {
	//     $this->tung_trang = ($this->trang - 1) * $this->sp_tungtrang;

	//     // Truy vấn để lấy tổng số bản ghi
	//     $countQuery = "SELECT COUNT(*) as total FROM sanpham WHERE hienthi=:hienthi";

	//     if (!empty($this->search)) {
	//         $countQuery .= " AND tensp LIKE :search";
	//     }

	//     if (!empty($this->filterdanhmuc)) {
	//         $countQuery .= " AND danhmuc = :filterdanhmuc";
	//     }

	//     if (!empty($this->filterthuonghieu)) {
	//         $countQuery .= " AND thuonghieu = :filterthuonghieu";
	//     }

	//     $stmtCount = $this->conn->prepare($countQuery);
	//     $stmtCount->bindParam(':hienthi', $this->hienthi, PDO::PARAM_INT);

	//     if (!empty($this->search)) {
	//         $searchParam = "%" . $this->search . "%";
	//         $stmtCount->bindParam(':search', $searchParam, PDO::PARAM_STR);
	//     }

	//     if (!empty($this->filterdanhmuc)) {
	//         $stmtCount->bindParam(':filterdanhmuc', $this->filterdanhmuc, PDO::PARAM_INT);
	//     }

	//     if (!empty($this->filterthuonghieu)) {
	//         $stmtCount->bindParam(':filterthuonghieu', $this->filterthuonghieu, PDO::PARAM_INT);
	//     }

	//     $stmtCount->execute();
	//     $totalResult = $stmtCount->fetch(PDO::FETCH_ASSOC);
	//     $total = $totalResult['total'];

	//     // Truy vấn chính với giới hạn LIMIT
	//     $query = "SELECT sp.*,dm.tendm as tendanhmuc,th.tenth as tenthuonghieu FROM sanpham sp inner join danhmuc dm on sp.danhmuc=dm.madm inner join thuonghieu th on sp.thuonghieu=th.math WHERE sp.hienthi=:hienthi";

	//     if (!empty($this->search)) {
	//         $query .= " AND sp.tensp LIKE :search";
	//     }

	//     if (!empty($this->filterdanhmuc)) {
	//         $query .= " AND sp.danhmuc = :filterdanhmuc";
	//     }

	//     if (!empty($this->filterthuonghieu)) {
	//         $query .= " AND sp.thuonghieu = :filterthuonghieu";
	//     }

	//     $query .= " ORDER BY sp.thoigian desc";

	//     $query .= " LIMIT :tungtrang, :sp_tungtrang";

	//     $stmt = $this->conn->prepare($query);

	//     $stmt->bindParam(':tungtrang', $this->tung_trang, PDO::PARAM_INT);
	//     $stmt->bindParam(':sp_tungtrang', $this->sp_tungtrang, PDO::PARAM_INT);
	//     $stmt->bindParam(':hienthi', $this->hienthi, PDO::PARAM_INT);

	//     if (!empty($this->search)) {
	//         $searchParam = "%" . $this->search . "%";
	//         $stmt->bindParam(':search', $searchParam, PDO::PARAM_STR);
	//     }

	//     if (!empty($this->filterdanhmuc)) {
	//         $stmt->bindParam(':filterdanhmuc', $this->filterdanhmuc, PDO::PARAM_INT);
	//     }

	//     if (!empty($this->filterthuonghieu)) {
	//         $stmt->bindParam(':filterthuonghieu', $this->filterthuonghieu, PDO::PARAM_INT);
	//     }

	//     $stmt->execute();

	//     return array(
	//         'total' => $total,
	//         'data' => $stmt->fetchAll(PDO::FETCH_ASSOC)
	//     );
	// }

	public function show(){
		$query = "SELECT * FROM sanpham where id=? limit 1";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id);
		$stmt->execute();
		
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->masp = $row['masp'];	
		$this->tensp = $row['tensp'];
		$this->danhmuc = $row['danhmuc'];		
		$this->soluong = $row['soluong'];
		$this->gianhap = $row['gianhap'];
		$this->giakm = $row['giakm'];
		$this->giaban = $row['giaban'];
		$this->hienthi = $row['hienthi'];	
		$this->id = $row['id'];
		$this->mota = $row['mota'];		
	}

	public function create(){

		$query = "INSERT INTO sanpham SET masp=:masp, tensp=:tensp, danhmuc=:danhmuc, soluong=:soluong, gianhap=:gianhap, giakm=:giakm, hienthi=:hienthi, giaban=:giaban, mota=:mota";
		$stmt = $this->conn->prepare($query);

		$this->masp = $this->masp;
		$this->tensp = $this->tensp;
		$this->danhmuc = $this->danhmuc;
		$this->soluong = $this->soluong;
		$this->gianhap = $this->gianhap;		
		$this->giakm = $this->giakm;
		$this->giaban = $this->giaban;		
		$this->hienthi = $this->hienthi;
		$this->mota = $this->mota;

		$stmt->bindParam(':masp',$this->masp);
		$stmt->bindParam(':tensp',$this->tensp);
		$stmt->bindParam(':danhmuc',$this->danhmuc);
		$stmt->bindParam(':soluong',$this->soluong);
		$stmt->bindParam(':gianhap',$this->gianhap);
		$stmt->bindParam(':giakm',$this->giakm);
		$stmt->bindParam(':giaban',$this->giaban);
		$stmt->bindParam(':mota',$this->mota);
		$stmt->bindParam(':hienthi',$this->hienthi);	
		if($stmt->execute()){
			return true;
		}


		printf("Error %s.\n" ,$stmt->error);
		return false;
	}

	public function update(){  
	    $query = "UPDATE sanpham SET masp=:masp, tensp=:tensp, danhmuc=:danhmuc, soluong=:soluong, gianhap=:gianhap, giakm=:giakm, giaban=:giaban, mota=:mota, hienthi=:hienthi WHERE id=:id";

	    $stmt = $this->conn->prepare($query);

	    $this->masp = $this->masp;
		$this->tensp = $this->tensp;
		$this->danhmuc = $this->danhmuc;
		$this->gianhap = $this->gianhap;
		$this->soluong = $this->soluong;		
		$this->giakm = $this->giakm;
		$this->giaban = $this->giaban;		
		$this->mota = $this->mota;		
		$this->hienthi = $this->hienthi;
		$this->id = $this->id;

		$stmt->bindParam(':id',$this->id);
		$stmt->bindParam(':masp',$this->masp);
		$stmt->bindParam(':tensp',$this->tensp);
		$stmt->bindParam(':danhmuc',$this->danhmuc);
		$stmt->bindParam(':soluong',$this->soluong);
		$stmt->bindParam(':gianhap',$this->gianhap);
		$stmt->bindParam(':giakm',$this->giakm);
		$stmt->bindParam(':giaban',$this->giaban);
		$stmt->bindParam(':mota',$this->mota);
		$stmt->bindParam(':hienthi',$this->hienthi);	
	    if ($stmt->execute()) {
	        return true;
	    }

	    printf("Error %s.\n", $stmt->error);
	    return false;
	}
	public function delete(){
		$query = "DELETE FROM sanpham WHERE id=:id";
		
		$stmt = $this->conn->prepare($query);

		$this->id = $this->id;

		$stmt->bindParam(':id',$this->id);
		if($stmt->execute()){
			return true;
		}
		printf("Error %s.\n" ,$stmt->error);
		return false;
	}


}	
 ?>
