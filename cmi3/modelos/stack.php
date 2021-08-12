<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.css"/>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.js"></script>
<?php
require_once("{$CFG->libdir}/formslib.php");

class queryStack{

  public function listar3(){

    global $DB;

    $sql2 = "SELECT  @s:=@s + 1 id_auto, u.id, concat(u.firstname,' ', u.lastname) as nombre, u.email, c.shortname,
              asg.roleid, asg.userid, r.shortname as stakholder FROM
              (select @s:=0) as s,
              mdl_user u
              INNER JOIN mdl_role_assignments as asg on asg.userid = u.id
              INNER JOIN mdl_context as con on asg.contextid = con.id
              INNER JOIN mdl_course c on con.instanceid = c.id
              INNER JOIN mdl_role r on asg.roleid = r.id
              where r.shortname = 'stakeholder'";

    $result2 = array();
    if ($datas = $DB->get_records_sql($sql2)) {
      foreach($datas as $data) {
        array_push($result2,(array)$data);
      }
    }
    return $result2;
  }

  public function getRol($id){
    global $DB;
    $query = "";
    $query .= " SELECT  distinct r.shortname as rol FROM";
    $query .= " (select @s:=0) as s,";
    $query .= " mdl_user u";
    $query .= " INNER JOIN mdl_role_assignments as asg on asg.userid = u.id";
    $query .= " INNER JOIN mdl_context as con on asg.contextid = con.id";
    $query .= " INNER JOIN mdl_course c on con.instanceid = c.id";
    $query .= " INNER JOIN mdl_role r on asg.roleid = r.id";
    $query .= " where  u.id = $id and r.shortname = 'stakeholder'";
    return $DB->get_records_sql($query);
  }
}
?>
