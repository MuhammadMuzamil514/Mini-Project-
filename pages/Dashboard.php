
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Auth System</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-8 pt-4">
            <h2>User Dashboard</h2>

            <p><?php echo htmlspecialchars($_SESSION['user_name'] ?? ''); ?></p>

            <form method="POST" action="/dashboard/store" class="mb-4">
                <div class="form-group">
                    <input type="text" name="title" class="form-control" placeholder="Post title" required>
                </div>
                <div class="form-group">
                    <textarea name="content" class="form-control" rows="4" placeholder="Write post..." required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Save Post</button>
            </form>

            <?php if (!empty($user_posts)) : ?>
                <div class="list-group mb-3">
                    <?php foreach ($user_posts as $post) : ?>
                        <div class="list-group-item">
                            <h5 class="mb-1"><?php echo htmlspecialchars($post['title']); ?></h5>
                            <p class="mb-1"><?php echo htmlspecialchars($post['content']); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <a href="/logout" class="btn btn-dark btn-sm">Logout</a>
        </div>
    </div>
</div>

</body>
</html>