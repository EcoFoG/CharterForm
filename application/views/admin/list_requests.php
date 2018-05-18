<script type="text/javascript">
$(document).ready(function() {
    $('#request-table').DataTable();
} );
</script>
<form method="get">
    <button class="m-2 btn btn-primary" type="submit" name="csv" />
    Export to CSV  <i class="fas fa-share"></i>
    </button>
</form>
<table id="request-table" class="table table-bordered table-stripped">
    <thead>
        <th>Id</th>
        <th>E-mail</th>
        <th>Name of the PI</th>
        <th>Title Research</th>
        <th>Date</th>
        <th>Approved</th>
        <th>Actions</th>
    </thead>
    <tbody>
        <?php
        foreach($requests as $value){
            if ($value->approved === "Declined") {
                $approved = $value->approved;
                $class = " class = \"table-danger\" ";
            } else if (isset($value->approved) && !empty($value->approved)) {
                $approved = $value->approved;
                $class = " class = \"table-success\" ";
            } else {
                $approved = "Not approved yet";
                $class = " class = \"table-secondary\" ";
            }
            echo "<tr>";
            echo "<td>$value->id</td>";
            echo "<td>$value->email</td>";
            echo "<td>$value->name_principal_investigator</td>";
            echo "<td>$value->title_research</td>";
            echo "<td>$value->date</td>";
            echo "<td$class>$approved</td>";
            echo "<td><a class=\"btn-sm btn-primary\" href=\"".base_url()."admin/show_request/$value->id\">Show <i class=\"fas fa-eye\"></i></a>";
            echo "</tr>";
        }?>
    </tbody>
</table>
