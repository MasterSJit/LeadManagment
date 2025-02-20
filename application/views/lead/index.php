    <div class="container mt-5">
        <h1>Lead Management</h1>
        <a href="<?php echo base_url('lead/new'); ?>" class="btn btn-primary mb-3">Add New Lead</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Date Added</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($leads as $lead): ?>
                    <tr>
                        <td><?php echo $lead->name; ?></td>
                        <td><?php echo $lead->email; ?></td>
                        <td><?php echo $lead->phone; ?></td>
                        <td><?php echo $lead->status; ?></td>
                        <td><?php echo $lead->date_added; ?></td>
                        <td>
                            <a href="<?php echo base_url('lead/edit/'.$lead->id); ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="<?php echo base_url('lead/delete/'.$lead->id); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php echo $links; ?>
    </div>