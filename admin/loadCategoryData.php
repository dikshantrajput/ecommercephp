<?php include "../includes/actions.inc.php";

    $output='<thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>';
    $conn = new Actions('categories');
    $data=$conn->SelectAll();
    if(isset($data)){

        foreach($data as $d){
            if($d["status"]==1){
                $d["status"]="Active";
                $class = "success";
            }else{
                $class="danger";
                $d["status"]="Inactive";
            }
            $output.='<tr class="align-middle">
                        <td>'.$d["id"].'</td>
                        <td>'.$d["name"].'</td>
                        <td><button data-id='.$d["id"].' class="status btn btn-'.$class.'">'.($d["status"]).'</button></td>
                        <td>
                            <button class="btn btn-danger dltbtn"  style="cursor:pointer;" data-id='.$d["id"].'>Delete</button>
                        </td>
                    </tr>';
        }
        echo $output;

    }
    
?>