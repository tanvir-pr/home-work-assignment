<section>
    <h2>Messages</h2>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead><tr><th>Sent at</th><th>Sender</th><th>Email</th><th>Subject</th><th>Message</th></tr></thead>
            <tbody>
                <?php foreach ($messages as $msg): ?>
                    <tr>
                        <td><?= htmlspecialchars($msg['created_at']) ?></td>
                        <td><?php if ($msg['user_id']): ?><?= htmlspecialchars($msg['family_name'] . ' ' . $msg['surname']) ?><?php else: ?>Guest<?php endif; ?></td>
                        <td><?= htmlspecialchars($msg['sender_email']) ?></td>
                        <td><?= htmlspecialchars($msg['subject']) ?></td>
                        <td><?= htmlspecialchars($msg['message_body']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>
