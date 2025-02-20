<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Edit User</h1>
        <?= validation_errors(); ?>
        <?= form_open('user/update/'.$user->id); ?>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= $user->name; ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= $user->email; ?>" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="text" class="form-control" id="password" name="password" value="">
                <input type="hidden" name="old_password" value="<?= $user->password; ?>">
            </div>
            <div class="form-group">
                <label for="assigned_leads">Assigned Leads</label>
                <select class="form-control" id="assigned_leads" name="assigned_leads[]" multiple>
                    <?php
                        foreach($leads as $lead)
                        {
                            if(!is_null($user->assigned_leads))
                            if(is_array(explode(',', $user->assigned_leads)))
                            {
                    ?>
                            <option value="<?= $lead->id ?>" <?= in_array($lead->id, explode(',', $user->assigned_leads)) ? 'selected' : ''; ?>><?= $lead->name ?></option>
                    <?php
                            }
                            if(is_null($user->assigned_leads))
                            {
                    ?>
                            <option value="<?= $lead->id ?>"><?= $lead->name ?></option>
                    <?php
                            }
                        }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update user</button>
        <?= form_close(); ?>
    </div>
</body>
</html>