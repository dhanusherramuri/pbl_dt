<html>
<head>
  <title>Complaint System</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.0.7/css/boxicons.min.css">
  <style>
    /* Custom styling */
    body {
      margin: 0;
      padding: 0;
    }

    #header {
      background-color: #f8f9fa;
      padding: 20px;
    }

    #content {
      display: flex;
      min-height: calc(100vh - 170px);
    }

    #complaint-table {
      flex: 1;
      padding: 20px;
      background-color: #f8f9fa;
    }

    .container {
      flex: 1;
      padding: 20px;
      background-color: #f8f9fa;
      overflow-y: auto;
    }

    #complaint-textarea {
      flex: 1;
      padding: 20px;
      background-color: #f8f9fa;
    }

    #registered-complaints {
      text-align: center;
      padding: 20px;
      background-color: #f8f9fa;
      font-size: 20px;
      margin-bottom: 20px;
    }

  </style>
</head>
<body>
  <header id="header">
    <nav class="navbar navbar-expand navbar-dark bg-dark">
      <a class="navbar-brand" href="#">Complaint System</a>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="anotherpage.html">profile</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="anotherpage.html">services</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="anotherpage.html">location</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="anotherpage.html">contact us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="anotherpage.html">complaints</a>
        </li>
      </ul>
    </nav>
  </header>

  <div id="content">
    <div id="complaint-table">
      <h4>Registered Complaints</h4>
      <table class="table">
        <thead>
          <tr>
            <th>Date</th>
            <th>Complaint</th>
            <th>Bus</th>
          </tr>
        </thead>
        <tbody id="complaint-table-body">
          <!-- Complaint rows will be dynamically added here -->
        </tbody>
      </table>
    </div>

    <div class="big">
      <div class="container">
        <h2>Complaint Here</h2>
        
        <form method="post" action="cmp.php">
        <div class="common-complaints">
          <select id="common-complaints" onchange="addComplaint()" name="cc">
            <option value="" selected hidden>Select a common complaint</option>
            <option value="Late Bus">Late Bus</option>
            <option value="Rude Driver">Rude Driver</option>
            <option value="Uncomfortable Seats">Uncomfortable Seats</option>
            <option value="Dirty Bus">Dirty Bus</option>
          </select>
        </div>

        <div class="common-complaints" >
          <select id="BUS" onchange="addBus()" name="bno">
            <option value selected hidden>Select bus</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
          </select>
        </div>
        <div id="complaint-textarea">
          <h4>Submit a Complaint</h4>
          <textarea class="form-control" id="t1" rows="5" placeholder="Enter your complaint" name="comp"></textarea>
          <input type="submit" class="btn btn-primary mt-3" name="submit" id="submit-btn">
          <!-- <button class="btn btn-primary mt-3" id="submit-btn" name="submit">Submit</button> -->
        </div>
      </form>
      </div>

      <div id="registered-complaints">
        <h4>Registered Complaints</h4>
        <p>Number of registered complaints: <span id="complaint-count">0</span></p>
      </div>
    </div>

    <script>
      // JavaScript code to update the complaint count dynamically
      var complaintCount = 0;
      function addComplaint() {
        var selectElement = document.getElementById("common-complaints");
        var selectedValue = selectElement.value;
        var complaintInput = document.getElementById("t1");

        if (selectedValue) {
          // complaintInput.value += selectedValue + "\n";
          // selectElement.value = "";
        }
      }

      function addBus() {
        var selectElement = document.getElementById("BUS");
        var selectedValue = selectElement.value;
        var complaintInput = document.getElementById("t1");

        if (selectedValue) {
          // complaintInput.value += "Bus: " + selectedValue + "\n";
          // selectElement.value = "";
        }
      }

      function updateComplaintCount() {
        var countElement = document.getElementById('complaint-count');
        countElement.textContent = complaintCount;
      }

      // Example event listener for submitting a complaint
      var submitButton = document.querySelector('#submit-btn');
      submitButton.addEventListener('click', function() {
        var textarea = document.querySelector('#complaint-textarea textarea');
        var complaint = textarea.value.trim();

        if (complaint !== '') {
          // Get current date and time
          var now = new Date();
          var date = now.toLocaleDateString();
          var time = now.toLocaleTimeString();

          // Create a new row for the complaint
          var tbody = document.querySelector('#complaint-table-body');
          var newRow = document.createElement('tr');
          var dateCell = document.createElement('td');
          var complaintCell = document.createElement('td');
          var busCell = document.createElement('td');
          dateCell.textContent = date + ' ' + time;
          complaintCell.textContent = complaint;
          busCell.textContent = getBusNumber(complaint);
          newRow.appendChild(dateCell);
          newRow.appendChild(complaintCell);
          newRow.appendChild(busCell);
          tbody.insertBefore(newRow, tbody.firstChild);

          // Increase the complaint count
          complaintCount++;
          updateComplaintCount();

          // Clear the textarea
          // textarea.value = '';
        }
      });

      function getBusNumber(complaint) {
        var regex = /Bus: (\d+)/;
        var match = complaint.match(regex);
        return match ? match[1] : '';
      }

      // Call the function initially to set the complaint count
      updateComplaintCount();
    </script>
  </div>
</body>
</html>

 <!-- <?php
if(isset($_POST['submit']))
{
    $cl=$_POST["comp"];
    $opt=$_POST["cc"];
    $bs=$_POST["bno"];
    $con=new mysqli("localhost","root","","dt");
    if($con->connect_error)
    die ("Connection error :".$con->connect_error);
    else
    {
        // $sq="INSERT INTO cb(complaints,ct,Upoaded_on) values('$cl','$opt',now())";
        // die("Submitted Sucessfully");
        
        $s=$con->prepare("insert into cb(complaints,rt_no,ct,Uploaded_on) values(?,?,?,now())");
        $s->bind_param("sss",$cl,$bs,$opt);
        $s->execute();
        echo "Submitted sucessfully";
        $s->close();
        $con->close();
        header("refresh:2;url=index.php");
    }
}
else
die("SELECT OPTION<br>");
?> -->