<div class="container mt-5">
        <h1>User Management</h1>
        <!-- <a href="<?php echo base_url('user/new'); ?>" class="btn btn-primary mb-3">Add New user</a> -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>User Role</th>
                    <th>Date Added</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo $user->name; ?></td>
                        <td><?php echo $user->email; ?></td>
                        <td><?php echo $user->user_role; ?></td>
                        <td><?php echo $user->created_at; ?></td>
                        <td>
                            <?php
                                if($_SESSION['user_id'] != $user->id)
                                {
                            ?>
                            <a href="<?php echo base_url('user/edit/'.$user->id); ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="<?php echo base_url('user/delete/'.$user->id); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                            <?php
                                }
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php echo $links; ?>
    </div>