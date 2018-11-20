<div class="col-sm-3">

  <div class="panel panel-default">
  <div class="panel-heading"> <strong>→ Top rated</strong></div>
  <div class="panel-body" style="height: 430px">
    <table class="table">
    <thead>
      <tr>
        <th>Rank</th>
        <th>Name</th>
        <th>Ratings</th>
      </tr>
    </thead>
        <!-- using php loop to print the table -->
      <?php 

          for($i=1; $i<=10; $i++){
            echo"<tr>";
            echo"<td>$i</td>";
            echo"<td>name-$i</td>";
            echo"<td>445</td>";
            echo"</tr>";
          }

      ?>
      </tr>
      </table>
     </div>
    </div>
</div>