// Menu Lateral
function toggleMenu() {
    const menu = document.getElementById('menu');
    menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
}

function showSection(sectionId) {
    const sections = document.querySelectorAll('main .section');
    sections.forEach(section => {
        section.style.display = 'none';
    });

    const activeSection = document.getElementById(sectionId);
    if (activeSection) {
        activeSection.style.display = 'block';
    }

    toggleMenu();
}

document.addEventListener('DOMContentLoaded', () => {
    showSection('estoque');
});

//Validação de Login
document.getElementById('login-form').addEventListener('submit', function(event) {
    event.preventDefault();

    const email = document.getElementById('email').value.trim();
    const senha = document.getElementById('senha').value;

    // Simulação de credenciais válidas
    const usuarios = [
      { email: 'admin@empresa.com', senha: 'admin123', destino: 'admin.html' },
    ];

    const usuario = usuarios.find(user => user.email === email && user.senha === senha);

    if (usuario) {
      window.location.href = usuario.destino;
    } else {
      alert('E-mail ou senha inválidos');
    }
  });
