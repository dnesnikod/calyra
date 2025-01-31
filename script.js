document.getElementById('urlForm').addEventListener('submit', async function(event) {
    event.preventDefault();

    const longUrl = document.getElementById('longUrl').value;
    const alias = document.getElementById('alias').value;
    const response = await fetch('shorten.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `longUrl=${encodeURIComponent(longUrl)}&alias=${encodeURIComponent(alias)}`
    });

    const shortUrl = await response.text();
    document.getElementById('shortUrl').textContent = `Short URL: ${shortUrl}`;
    document.getElementById('shortUrl').classList.remove('hidden');
    document.getElementById('shortUrl').classList.add('shown');
    document.getElementById('copyConfirmation').classList.add('hidden'); // Hide confirmation message if already visible
});

function copyToClipboard() {
    const shortUrlText = document.getElementById('shortUrl').textContent.replace('Short URL: ', '');
    navigator.clipboard.writeText(shortUrlText).then(() => {
        const confirmationMessage = document.getElementById('copyConfirmation');
        confirmationMessage.classList.remove('hidden');
        confirmationMessage.classList.add('shown');
    }).catch(err => {
        console.error('Failed to copy text: ', err);
    });
}
