function playMusic() {
    musicControls.style.display = 'block';
    musicControls.classList.remove('hidden'); // Убираем класс скрытия
    audio.play().catch(function(error) {
        console.error("Ошибка воспроизведения:", error);
    });
}
