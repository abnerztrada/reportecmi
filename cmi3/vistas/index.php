<?php require_once('../../../config.php');
require_once('../modelos/agrupacion.php');
require_once('../modelos/stack.php');

global $DB, $OUTPUT, $PAGE;

$PAGE->set_url('/blocks/cmi3/vistas/index_agrupacion.php');
$PAGE->set_pagelayout('standard');
$PAGE->set_heading(get_string('edithtml', 'block_cmi3'));
$PAGE->set_context(\context_system::instance());
$settingsnode = $PAGE->settingsnav->add(get_string('cmisetting', 'block_cmi3'));
$editurl = new moodle_url('/blocks/cmi3/vistas/index_agrupacion.php');
$editnode = $settingsnode->add(get_string('editpage', 'block_cmi3'), $editurl);
$editnode->make_active();


$actualizateform2 = new queryStack();
$stak = $actualizateform2->getRol($USER->id);
$rol = $stak["stakeholder"]->rol;
$nombre = $USER->id;
echo $nombre;

// echo '<pre>';
//   print_r($rol);
// echo '</pre>';


  if($rol == "stakeholder" || is_siteadmin()){
  echo $OUTPUT->header();
  echo "<h2>Autogestión de avance</h2>";
  echo '<a style="margin-left: 415px" href="http://54.161.158.96/blocks/cmi3/vistas/index.php" class="btn btn-primary">Reiniciar filtro</a>';
  $actualizateform = new queryAgrupacion();
  $agrupacion = $actualizateform->listar();
  $templatecontext = (object)[
      'agrupaciones' => $agrupacion,
  ];


  // die();
  echo $OUTPUT->render_from_template('block_cmi3/agrupacion',$templatecontext);
  echo $OUTPUT->footer();
}else {
    echo '<script>
      swal({
          title: "Warning!",
          text: "No tienes permisos!",
          type: "warning"
        }).then(function(){
            window.location = "http://54.161.158.96/my/index.php";
          });
      </script>';
}
?>
