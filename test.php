<script>
const asa='<?php include "./includes/mysql_connect.php"; $conn=connect_mysql(); echo $conn->query("select * from full_detail")->fetch_assoc()['id']; ?>';
alert(asa);
</script>