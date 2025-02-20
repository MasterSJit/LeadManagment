<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Lead</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Lead</h1>
        <?php echo validation_errors(); ?>
        <?php echo form_open('lead/update/'.$lead->id); ?>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $lead->name; ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $lead->email; ?>" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $lead->phone; ?>" required>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="New" <?php echo ($lead->status == 'New') ? 'selected' : ''; ?>>New</option>
                    <option value="In Progress" <?php echo ($lead->status == 'In Progress') ? 'selected' : ''; ?>>In Progress</option>
                    <option value="Closed" <?php echo ($lead->status == 'Closed') ? 'selected' : ''; ?>>Closed</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update Lead</button>
        <?php echo form_close(); ?>
    </div>
</body>
</html>