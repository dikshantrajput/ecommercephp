<?php include "../includes/actions.inc.php";

    $output='<thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile No</th>
                    <th>Comment</th>
                    <th>TimeStamp</th>
                    <th>Action</th>
                </tr>
            </thead>';
    $conn = new Actions('contact_us');
    $data=$conn->SelectAll();
    if(isset($data)){

        foreach($data as $d){
            
            $output.='<tr class="align-middle">
                        <td>'.$d["id"].'</td>
                        <td>'.$d["name"].'</td>
                        <td>'.$d["email"].'</td>
                        <td>'.$d["mobile"].'</td>
                        <td>'.$d["comment"].'</td>
                        <td>'.$d["timestamp"].'</td>
                        <td>
                            <button class="btn btn-danger dltbtn"  style="cursor:pointer;" data-id='.$d["id"].'>Delete</button>
                        </td>
                    </tr>';
        }
        echo $output;

    }
    
?>