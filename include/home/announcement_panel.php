  <nav id="myScrollspy">
      <ul class="nav nav-pills nav-stacked" data-spy="affix" data-offset-top="1">
      <div class="panel panel-default">
        <div class="panel-heading"> <strong>→ Announcements</strong></div>
        <div class="panel-body" style="height: 250px;">
            <li><a href="#section1">
            <strong>
              <p id="greet"></p>
              <script>
                  function myFunction() {
                      var hour = new Date().getHours(); 
                      var greeting;
                      if (hour < 18) {
                          greeting = "Good day ";
                      } else {
                          greeting = "Good Evening ";
                      }
                      document.getElementById("greet").innerHTML = greeting;
                  }
                  document.getElementById("greet").innerHTML = myFunction().greeting;
              </script>
             </strong>
            </a></li>
            
        </div>
      </div>
      </ul>
    </nav>