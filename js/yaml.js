// js/yaml.js

// Pfad zur YAML-Datei (anpassen, falls du texts.yaml woanders liegen hast)
const YAML_PATH = './Site/texts.yaml';

let yamlData = null;
let currentLang = 'de';

// 1) texts.yaml per fetch holen und parsen
async function loadYAML(path) {
    const res = await fetch(path);
    if (!res.ok) {
        throw new Error('Konnte texts.yaml nicht laden: ' + res.statusText);
    }
    const text = await res.text();
    return jsyaml.load(text);
}

// 2) Eine Funktion, die die gewünschte Sektion rendert
function renderSection() {
    // Element, in das wir schreiben (ID = "home-container")
    const container = document.getElementById('home-container');
    if (!container) return;

    // Aus dem data-Attribut lesen: welche Sektion laden?
    const sectionId = container.getAttribute('data-section-id');
    // Vorher leeren
    container.innerHTML = '';

    if (!yamlData || !Array.isArray(yamlData.sections)) return;

    // Finde das Objekt mit der passenden ID (entweder String oder Zahl)
    const targetSection = yamlData.sections.find(sec => String(sec.id) === String(sectionId));
    if (!targetSection) {
        container.innerHTML = '<p style="color:red;">Sektion mit id=' + sectionId + ' nicht gefunden.</p>';
        return;
    }

    // 2a) Titel einfügen (h2)
    const titleText = targetSection.title?.[currentLang] || '';
    if (titleText.trim() !== '') {
        const h2 = document.createElement('h2');
        h2.textContent = titleText;
        container.appendChild(h2);
    }

    // 2b) Content einfügen (Absätze)
    const contentRaw = targetSection.content?.[currentLang] || '';
    if (contentRaw.trim() !== '') {
        const contentDiv = document.createElement('div');
        contentDiv.className = 'content';
        // Text nach doppeltem Zeilenumbruch splitten
        const paragraphs = contentRaw.split(/\n\n+/);
        paragraphs.forEach(parText => {
            const p = document.createElement('p');
            p.textContent = parText.trim();
            contentDiv.appendChild(p);
        });
        container.appendChild(contentDiv);
    }
}

// 3) Event‐Listener für Sprachwechsel
document.getElementById('lang-select').addEventListener('change', (e) => {
    currentLang = e.target.value;
    renderSection();
});

// 4) Beim Laden der Seite: YAML einlesen und initial rendern
document.addEventListener('DOMContentLoaded', async () => {
    try {
        yamlData = await loadYAML(YAML_PATH);
        renderSection();
    } catch (err) {
        console.error('Fehler beim Laden/Parsen von texts.yaml:', err);
        const container = document.getElementById('home-container');
        if (container) {
            container.innerHTML = '<p style="color:red;">Fehler beim Laden der Inhalte. Bitte prüfe texts.yaml.</p>';
        }
    }
});
