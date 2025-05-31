// 1) Pfad zur YAML-Datei (im selben Ordner wie diese PHP-Datei)
const YAML_PATH = './Site/texts.yaml';

let yamlData = null;
let currentLang = 'de';

// texts.yaml per fetch holen und parsen
async function loadYAML(path) {
    const res = await fetch(path);
    if (!res.ok) throw new Error('Konnte texts.yaml nicht laden: ' + res.statusText);
    const text = await res.text();
    return jsyaml.load(text);
}

// Nur Home (id = 1) rendern
function renderHome() {
    const container = document.getElementById('home-container');
    container.innerHTML = ''; // Inhalt vorher leeren

    if (!yamlData || !Array.isArray(yamlData.sections)) return;

    // Objekt mit id === "1" suchen (Home)
    const homeSection = yamlData.sections.find(sec => String(sec.id) === '1');
    if (!homeSection) {
        container.innerHTML = '<p style="color:red;">Home-Inhalte (id=1) nicht gefunden.</p>';
        return;
    }

    // Überschrift einfügen
    const titleText = homeSection.title?.[currentLang] || '';
    if (titleText.trim() !== '') {
        const h2 = document.createElement('h2');
        h2.textContent = titleText;
        container.appendChild(h2);
    }

    // Mehrzeiligen Text in Absätze aufteilen
    const contentRaw = homeSection.content?.[currentLang] || '';
    if (contentRaw.trim() !== '') {
        const contentDiv = document.createElement('div');
        contentDiv.className = 'content';
        const paragraphs = contentRaw.split(/\n\n+/);
        paragraphs.forEach(parText => {
            const p = document.createElement('p');
            p.textContent = parText.trim();
            contentDiv.appendChild(p);
        });
        container.appendChild(contentDiv);
    }
}

// Wenn der Nutzer die Sprache wechselt, neu rendern
document.getElementById('lang-select').addEventListener('change', (e) => {
    currentLang = e.target.value;
    renderHome();
});

// Beim Laden der Seite: YAML holen und Home darstellen
document.addEventListener('DOMContentLoaded', async () => {
    try {
        yamlData = await loadYAML(YAML_PATH);
        renderHome();
    } catch (err) {
        console.error('Fehler beim Laden/Parsen von texts.yaml:', err);
        document.getElementById('home-container')
            .innerHTML = '<p style="color:red;">Fehler beim Laden der Home-Inhalte. Bitte prüfe texts.yaml.</p>';
    }
});