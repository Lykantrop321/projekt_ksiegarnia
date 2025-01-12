// Funkcja do zmiany arkusza stylów
function changeStylesheet(styleName) {
    var currentStylesheet = document.getElementById('theme-style');
    if (currentStylesheet) {
        currentStylesheet.href = `/css/${styleName}.css`; // Aktualizacja ścieżki do arkusza stylów
        localStorage.setItem('selectedStyle', styleName); // Zapis wybranego stylu do localStorage
    }
}

// Funkcja do zmiany wielkości czcionki
function changeFontSize(action) {
    const body = document.body;
    let currentSize = window.getComputedStyle(body, null).getPropertyValue('font-size');
    currentSize = parseFloat(currentSize);

    if (action === 'increase' && currentSize < 24) {
        body.style.fontSize = (currentSize + 2) + 'px';
    } else if (action === 'decrease' && currentSize > 10) {
        body.style.fontSize = (currentSize - 2) + 'px';
    }

    localStorage.setItem('selectedFontSize', body.style.fontSize); // Zapisanie aktualnego rozmiaru czcionki
}

// Funkcja do rozpoczęcia mówienia
const synth = window.speechSynthesis; // Pobranie interfejsu syntezatora mowy
function speakText() {
    if (synth.speaking) {
        synth.cancel(); // Zatrzymanie mówienia, jeśli już coś jest mówione
    }
    let textToSpeak = document.body.textContent || document.body.innerText;
    let utterance = new SpeechSynthesisUtterance(textToSpeak);
    synth.speak(utterance);
}

// Funkcja do zatrzymania mówienia
function stopSpeaking() {
    if (synth.speaking) {
        synth.cancel();
    }
}

document.addEventListener('DOMContentLoaded', function () {
    var styleSelector = document.getElementById('style-selector');
    var selectedStyle = localStorage.getItem('selectedStyle');
    var selectedFontSize = localStorage.getItem('selectedFontSize');

    // Ustawienie wybranego stylu po załadowaniu strony
    if (selectedStyle) {
        document.getElementById('theme-style').href = `/css/${selectedStyle}.css`;
        styleSelector.value = selectedStyle;
    }

    // Ustawienie wielkości czcionki zapisanej w localStorage
    if (selectedFontSize) {
        document.body.style.fontSize = selectedFontSize;
    }

    if (styleSelector) {
        styleSelector.addEventListener('change', function () {
            changeStylesheet(this.value); // Wywołanie funkcji zmiany arkusza stylów
        });
    }
});
