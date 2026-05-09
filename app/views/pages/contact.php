<section>
    <h2>Contact</h2>
    <p>Send a message to the site owner.</p>
    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger"><ul class="mb-0"><?php foreach ($errors as $error): ?><li><?= htmlspecialchars($error) ?></li><?php endforeach; ?></ul></div>
    <?php endif; ?>
    <form id="contactForm" action="<?= BASE_URL ?>?route=contact" method="post" novalidate>
        <div class="mb-3"><label class="form-label">Name</label><input class="form-control" name="sender_name" value="<?= htmlspecialchars($old['sender_name'] ?? '') ?>"></div>
        <div class="mb-3"><label class="form-label">Email</label><input class="form-control" name="sender_email" value="<?= htmlspecialchars($old['sender_email'] ?? '') ?>"></div>
        <div class="mb-3"><label class="form-label">Subject</label><input class="form-control" name="subject" value="<?= htmlspecialchars($old['subject'] ?? '') ?>"></div>
        <div class="mb-3"><label class="form-label">Message</label><textarea class="form-control" name="message_body" rows="4"><?= htmlspecialchars($old['message_body'] ?? '') ?></textarea></div>
        <button class="btn btn-primary">Send message</button>
    </form>
</section>
