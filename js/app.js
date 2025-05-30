document.addEventListener('DOMContentLoaded', () => {
    const content = `
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A rerum blanditiis soluta nesciunt doloremque voluptate earum tempore fugit eveniet veritatis adipisci magni alias vitae dignissimos incidunt repellat ea quisquam amet eligendi perspiciatis pariatur excepturi magnam omnis aliquam quo aperiam non quibusdam sit molestiae ex. Quasi ipsa libero magnam maiores delectus.</p>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quasi vitae perferendis natus porro voluptate molestias deserunt impedit numquam recusandae ducimus dolorem facilis qui autem dolorum quam omnis repellendus asperiores neque excepturi ipsa! Rerum corrupti similique adipisci dolorem cupiditate modi veritatis eum doloribus placeat at quos explicabo et quidem! Illo incidunt obcaecati quo rem nesciunt dolorum fugit vitae voluptates eaque soluta!</p>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad eligendi voluptates suscipit nesciunt nisi illo placeat qui voluptas quas vero voluptatibus eius in voluptate. Itaque eius nobis error id ullam officiis consectetur? Laboriosam commodi excepturi distinctio voluptas. Quam mollitia culpa ipsa? Modi magni officiis quibusdam nulla eum magnam quo in distinctio quis deleniti aliquid minima cum. Assumenda magni quae incidunt aliquam? Omnis eum aspernatur molestiae provident in quod delectus dolor sint vero? Quibusdam tempore similique.</p>
    <h2>Keep scrolling..</h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eveniet eum aspernatur quibusdam ad provident molestiae adipisci numquam vitae molestias quidem vero nostrum voluptates harum! Vero veniam adipisci minima corporis quidem sunt omnis illum similique consectetur enim atque autem distinctio quas deserunt ex amet itaque ipsa cumque sed asperiores doloremque aliquid praesentium nihil tenetur cum aliquam.</p>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perspiciatis ratione blanditiis vero rem cupiditate magni praesentium veniam quibusdam dicta recusandae? Fugit fuga debitis inventore possimus distinctio perferendis.</p>
    `;
<<<<<<< HEAD
    document.getElementById('lorem').innerHTML = content;
});

// Mobile menu functionality
document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.querySelector('.menu-toggle');
    const navbar = document.querySelector('.navbar');
    const body = document.body;

    if (menuToggle && navbar) {
        menuToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            menuToggle.classList.toggle('active');
            navbar.classList.toggle('active');
            body.classList.toggle('menu-open');
        });

        // Close menu when clicking outside
        document.addEventListener('click', function(event) {
            if (!navbar.contains(event.target) && !menuToggle.contains(event.target)) {
                menuToggle.classList.remove('active');
                navbar.classList.remove('active');
                body.classList.remove('menu-open');
            }
        });

        // Close menu when clicking a link
        navbar.querySelectorAll('.link').forEach(link => {
            link.addEventListener('click', function() {
                menuToggle.classList.remove('active');
                navbar.classList.remove('active');
                body.classList.remove('menu-open');
            });
        });

        // Prevent menu from staying open on window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                menuToggle.classList.remove('active');
                navbar.classList.remove('active');
                body.classList.remove('menu-open');
            }
        });
    }
<<<<<<< HEAD
=======
=======
    if(document.getElementById("lorem")!=null){
        document.getElementById('lorem').innerHTML = content;
    }
    
>>>>>>> 96d2a7f009ac10cdd34ae475709c158999c8f8d8
>>>>>>> c38472f0d6529f2a7e1df3195f8520dcf34d3f72
});