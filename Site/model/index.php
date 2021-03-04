<?php


/*
insert into testclassstudent
select testclasses.id as classId, teststudents.id as studentId from
(values
("classId", "studentId"),
("ACD 2A","756.0952.4398.51"),
("ACD 2A","756.8378.5618.97"),
("ACD 2A","756.4087.0899.50"),
("ACD 2A","756.5653.1555.74"),
("ACD 2A","756.8686.1680.85"),
("ACD 2A","756.7254.8493.19"),
("ACD 2A","756.2668.7191.66"),
("ACD 2A","756.9008.7483.98"),
("ACD 2A","756.6984.5899.84"),
("ACD 1A","756.9965.5333.58"),
("ACD 1A","756.3974.6292.48"),
("ACD 1A","756.7899.9307.17"),
("ACD 1A","756.0831.1691.69"),
("ATP 3A","756.3849.6589.91"),
("ATP 3A","756.1704.3448.43"),
("ATP 3A","756.1710.4200.81"),
("ATP 3A","756.0546.1906.94"),
("ATP 3A","756.4311.8927.52"),
("ATP 3A","756.2421.7614.18"),
("ATP 3A","756.4456.0748.08"),
("ATP 3A","756.9037.3002.91"),
("ATP 3A","756.1848.9373.83"),
("ATP 3A","756.4150.9886.09"),
("ATP 2A","756.9439.1897.84"),
("ATP 2A","756.2578.5431.41"),
("ATP 2A","756.6275.6720.81"),
("ATP 2A","756.8568.0113.79"),
("ATP 2A","756.9471.7569.13"),
("ATP 2A","756.0789.5922.24"),
("ATP 2A","756.2942.8217.14"),
("ATP 2A","756.2630.1203.41"),
("ATP 2A","756.4782.3214.09"),
("ATP 2A","756.9836.6277.04"),
("ATP 2A","756.7233.6494.80"),
("ATP 2A","756.3934.7163.15"),
("ATP 2A","756.5724.8624.55"),
("ATP 2A","756.7396.4175.06"),
("ATP 2A","756.9937.2006.46"),
("ATP 1A","756.0113.0552.58"),
("ATP 1A","756.9141.7514.08"),
("ATP 1A","756.4029.3810.81"),
("ATP 1A","756.3201.5497.76"),
("ATP 1A","756.4435.7416.39"),
("ATP 1A","756.1249.4548.30"),
("ATP 1A","756.1177.0052.03"),
("ATP 1A","756.1338.4103.27"),
("ATP 1A","756.5104.1344.93"),
("ATP 1A","756.3908.3901.69"),
("ATP 1A","756.4093.5812.57"),
("ATP 1A","756.5607.6360.50"),
("ATP 1A","756.3536.6009.68"),
("ATP 1A","756.4885.0430.31"),
("ATP 1A","756.3569.9723.46"),
("CPA-21","756.4048.4225.29"),
("CPA-21","756.3016.1715.75"),
("CPA-21","756.2837.3091.50"),
("CPA-21","756.0365.3630.64"),
("CPA-21","756.2844.2082.00"),
("FCB 3A","756.7465.9290.84"),
("FCB 3A","756.3417.9487.07"),
("FCB 3A","756.1880.4193.80"),
("FCB 3A","756.0491.2087.27"),
("FCB 3A","756.8804.3541.09"),
("FCB 3A","756.6248.8098.96"),
("FCB 3A","756.4954.7658.19"),
("FCB 3A","756.3754.4822.47"),
("FCB 3A","756.9749.3056.07"),
("FCB 3A","756.9061.5562.06"),
("FCB 3A","756.6295.9484.70"),
("FCB 3A","756.4422.5082.52"),
("FCB 3A","756.3567.5829.36"),
("FCB 3A","756.0197.9265.50"),
("FCB 3B","756.7819.0870.88"),
("FCB 3B","756.3904.7247.15"),
("FCB 3B","756.8013.3610.73"),
("FCB 3B","756.4014.3784.54"),
("FCB 3B","756.1252.9175.06"),
("FCB 3B","756.0613.0228.04"),
("FCB 3B","756.6508.6152.43"),
("FCB 3B","756.5548.5470.57"),
("FCB 3B","756.8887.3754.66"),
("FCB 3B","756.6766.9150.17"),
("FCB 3B","756.6335.1468.59"),
("FCB 3B","756.3562.8205.14"),
("FCB 3B","756.9729.4647.44"),
("FCB 2A","756.9903.7465.43"),
("FCB 2A","756.7134.0228.56"),
("FCB 2A","756.3699.2927.41"),
("FCB 2A","756.5766.5894.19"),
("FCB 2A","756.4517.3845.70"),
("FCB 2A","756.2404.1349.87"),
("FCB 2A","756.7805.3179.91"),
("FCB 2A","756.9442.0136.32"),
("FCB 2A","756.4659.0974.13"),
("FCB 2A","756.7007.5293.07"),
("FCB 2A","756.6834.8624.65"),
("FCB 2A","756.4444.8462.40"),
("FCB 2A","756.1363.8350.58"),
("FCB 2B","756.7310.4878.51"),
("FCB 2B","756.5181.3223.94")
)
join testclasses on (testclasses.name = classId)
join teststudents on (teststudents.avs = studentId);
*/




print_r("hey");


/*
$db = new SQLite3('testDB.db');
$classes = $db->query('select testclasses.name from testclasses;');
*/

$pdo = new PDO('sqlite:testDB.db');

$stm = $pdo->query("SELECT testclasses.classname FROM testclasses;");
$classes = $stm->fetchAll(PDO::FETCH_COLUMN);
$classes = array_chunk($classes, 10)[0];

$singleClass = null;

if(isset($_GET["action"]))
{
  switch($_GET["action"])
  {
    case "getClass":
      $sql = "SELECT absences_periods.id as id, class_students.studentId as studentId, classname, firstname, lastname, day,
      p01, p02, p03, p04, p05, p06, p07, p08, p09, p10,
      c01, c02, c03, c04, c05, c06, c07, c08, c09, c10
      FROM class_students
      LEFT JOIN (SELECT * FROM absences_periods WHERE day=:day) AS absences_periods ON class_students.studentId=absences_periods.studentId
      WHERE classname=:class";

      $stm = $pdo->prepare($sql);
      //$stm = $pdo->prepare("SELECT class_students.firstname, class_students.lastname FROM class_students WHERE class_students.classname=:class;");
      $stm->execute(array(":class" => $_GET["class"], "day" => date("Y-m-d")));
      $singleClass = $stm->fetchAll(PDO::FETCH_ASSOC);
    break;

    case "update":
      $sql = "UPDATE testabsences SET ".$_GET["period"]."=(".$_GET["period"]."%(SELECT COUNT(*) FROM teststates))+1 WHERE studentId = :studentId AND day = :day";

      $stm = $pdo->prepare($sql);
      $stm->execute(array(":studentId" => $_GET["student"], ":day" => $_GET["day"]));

      header("Location:?action=getClass&class=".$_GET["back"]);
      exit();
    break;

    case "insert":
      $sql = "INSERT INTO testabsences (day, studentId, ".$_GET["period"].") VALUES (:day, :studentId, 2)";

      $stm = $pdo->prepare($sql);
      $stm->execute(array(":studentId" => $_GET["student"], ":day" => $_GET["day"]));

      header("Location:?action=getClass&class=".$_GET["back"]);
      exit();
    break;

    case "z":
    break;

    default:
      print_r("nothing");
  }
}


/*
if(isset($_GET["action"]))
{
  switch($_GET["action"])
  {
    case "get":
      $version = $db->querySingle('SELECT SQLITE_VERSION()');
      print_r($version);
    break;

    case "select":
      $res = $db->query('select testclasses.name, teststudents.firstname, teststudents.lastname from testclassstudent inner join testclasses on testclasses.id = testclassstudent.classId inner join teststudents on teststudents.id = testclassstudent.studentId;');

      echo("<br>");
      while ($row = $res->fetchArray())
      {
        print_r($row);echo("<br>");
      }
    break;

    case "insert":
      //$db->exec("CREATE TABLE cars(id INTEGER PRIMARY KEY, name TEXT, price INT)");
    break;

    default:
      print_r("nothing");
  }

  //$version = $db->querySingle('SELECT SQLITE_VERSION()');




}
*/




?>


<table style="border: 1px solid black;">
  <tr>
    <?php foreach($classes as $class): ?>
      <td style="border: 1px solid black;"><a href="?action=getClass&class=<?=$class?>"><?=$class?></a></td>
    <?php endforeach ?>
  </tr>
</table>


<?php if($singleClass != null): ?>
  <table style="border: 1px solid black;">
    <?php foreach($singleClass as $student): ?>
      <tr style="height: 45px;">
        <td style="border: 1px solid black;"><?=$student["firstname"]?></td>
        <td style="border: 1px solid black;"><?=$student["lastname"]?></td>

        <?php for($i = 1; $i <= 10; $i++) :?>
          <?php
            $period = "p".sprintf("%02d", $i);
            $periodColor = "c".sprintf("%02d", $i);
            $action = "";
            $text = "";
            $textColor = "";

            if($student["day"] != null) {
              $action.= "?action=update&student=".$student["studentId"]."&day=".date("Y-m-d")."&period=".$period."&back=".$_GET["class"];
            }
            else {
              $action.= "?action=insert&student=".$student["studentId"]."&day=".date("Y-m-d")."&period=".$period."&back=".$_GET["class"];
            }

            if($student[$period] != null) {
              $text = $student[$period];
              $textColor = $student[$periodColor];
            }
            else {
              $text = "Présent";
              $textColor = "lime";
            }
          ?>

          <td onclick="window.location='<?= $action ?>'" style="width: 80px; border: 1px solid black; background-color: <?=$textColor?>">
            <a><?= $text ?></a>
          </td>
        <?php endfor ?>
      </tr>
    <?php endforeach ?>
  </table>
<?php endif ?>






<?php





























//.
