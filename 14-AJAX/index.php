<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP MYSQL AJAX CRUD</title>
    <link rel="stylesheet" href="bootstrap.css">
</head>
<body class="bg-light">
    <div class="container mt-4">
        <h1 class="">AJAX CRUD DATA TABLE</h1>

        <!-- FORM CREATION -->
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <form id="studentForm" action="" class="row g-3">
                    <input type="hidden" id="id">

                    <div class="col-md-3">
                        <label for="" class="form-label">Name</label>
                        <input id="name" type="text" class="form-control" required>
                    </div>

                    <div class="col-md-3">
                        <label for="" class="form-label">Email</label>
                        <input id="email" type="email" class="form-control" required>
                    </div>

                    <div class="col-md-3 d-grid">
                        <label for="" class="form-label invisible">Submit</label>
                        <button class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- TABLE CARD -->
        <div class="card shadow-sm">
            <div class="card-body" id="table-data">
                <!-- AJAX TABLE WILL LOAD HERE -->
            </div>
        </div>
    </div>  

    <script>
        // LOADING STUDENTS FROM FETCH.PHP
        function loadStudents() {
            // CREATE XMLHTTPREQUEST OBJECT
            const xhr = new XMLHttpRequest();
            xhr.open("GET", "fetch.php", true);

            xhr.onload = function() {
                if(xhr.status === 200){
                    document.getElementById("table-data").innerHTML = xhr.responseText;
                }
            };

            xhr.send();
        }

        loadStudents();

        // EDITING A STUDENT RECORD
        function editStudent(id, name, email){
            document.getElementById("id").value = id;
            document.getElementById("name").value = name;
            document.getElementById("email").value = email;
        }

        // DELETING A STUDENT RECORD
        function deleteStudent(id){
            if(!confirm("Delete this student?")) return;
            
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "delete.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onload = function(){
                if(xhr.status === 200){
                    loadStudents();
                }
            };
            xhr.send("id=" + encodeURIComponent(id));
        }



        //GRAB FORM INFO AND SAVE IN DATABASE
        document.getElementById("studentForm").addEventListener("submit", function(e){
            e.preventDefault();

            const id = document.getElementById("id").value;
            const name = document.getElementById("name").value;
            const email = document.getElementById("email").value;

            const xhr = new XMLHttpRequest();
            xhr.open("POST", "save.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onload = function(){
                console.log("Response from save.php:", xhr.responseText);

                if(xhr.status === 200){

                    if(xhr.responseText.trim() === "success"){
                        document.getElementById("studentForm").reset();
                        loadStudents();
                    } else {
                        alert(xhr.responseText);
                    }

                } else {
                    alert("Request failed. HTTP status: " + xhr.status);
                }
            };

            xhr.send(
                "id=" + encodeURIComponent(id) +
                "&name=" + encodeURIComponent(name) +
                "&email=" + encodeURIComponent(email)
            );
        });
    </script>
</body>
</html>