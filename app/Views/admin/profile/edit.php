<section class="auth-card">
    <h1>Mon profil</h1>

    <form action="<?= e($this->config['app']['base_url']) ?>/admin/profile/update" method="post" id="profile-form">
        <input type="hidden" name="_csrf" value="<?= e($csrfToken) ?>">
        <input type="hidden" name="description" id="description-input">

        <label for="name">Nom</label>
        <input type="text" id="name" name="name" maxlength="50" required value="<?= e($user['name']) ?>">

        <label for="github_url">Lien GitHub</label>
        <input type="url" id="github_url" name="github_url" value="<?= e((string) ($user['github_url'] ?? '')) ?>">

        <label>Description (éditeur riche)</label>
        <div id="editor" style="background:#fff; min-height:160px; border:1px solid #d1d5db; border-radius:8px; padding:0.5rem;">
            <?= $user['description'] ?? '' ?>
        </div>

        <button type="submit" style="margin-top:1rem;">Enregistrer</button>
    </form>
</section>

<link href="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.snow.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.min.js"></script>
<script>
    const quill = new Quill('#editor', {
        theme: 'snow',
        modules: {
            toolbar: [
                ['bold', 'italic', 'underline'],
                [{ list: 'ordered' }, { list: 'bullet' }],
                ['link'],
                ['clean']
            ]
        }
    });

    document.getElementById('profile-form').addEventListener('submit', function () {
        document.getElementById('description-input').value = quill.root.innerHTML;
    });
</script>
