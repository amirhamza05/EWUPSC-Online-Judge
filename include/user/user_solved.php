<div class="header_user">Solved List</div>

<div class="container" style="margin:20px;">

<?php 
  $row_num = 1;    
  foreach ($solve_list as $key => $value1) {
if($row_num == 1){
?>
  <div class="row">
<?php

    }


        $pid=$value1;
        $pname=$problems_info[$pid]['name'];
        echo "<a class='col-md-2 problem_list_cl' href='problem.php?problem_id=$pid'>($pid) $pname</a>";

        if($row_num == 4){
            $row_num = 1;
            ?>
              </div>
            <?php

        }else{
          $row_num++;
        }
      }

?>
</div>