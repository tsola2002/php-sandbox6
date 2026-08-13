<?php

require "database.php";

$query =  "SELECT * FROM tbl_student";
$result  = mysqli_query($connection, $query);

echo "<table class='table table-bordered table-striped'>";
echo "<thead class='table-dark'>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th width='160'>Actions</th>
        </tr>
      </thead>
      <tbody>";

while ($row = mysqli_fetch_assoc($result)){
    echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['name']}</td>
            <td>{$row['email']}</td>
            <td>
                <button class='btn btn-sm btn-warning me-1'
                 onclick=\"editStudent(
                 '{$row['id']}',
                 '{$row['name']}',
                 '{$row['email']}',
                 )\">
                 Edit
                </button>

                <button class='btn btn-sm btn-danger'
                    onclick=\"deleteStudent({$row['id']})\">
                    Delete
                </button>
            </td>
           </tr>";
}
echo "</tbody></table>";