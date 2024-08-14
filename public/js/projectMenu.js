// Ensure csrfToken is defined
var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

function loadProjectsMenu() {
    $.ajax({
        url: '/advertiser/menu', 
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        success: function (response) {
            var projectsMenu = $('#projects-menu');
            projectsMenu.children('li:not(:first)').remove();
            if (response.data.length > 0) {
                var selectedProjectId = "{{ session('selected_project_id') }}";
                var firstProject = response.data[0];
                var selectedProject = selectedProjectId ? response.data.find(project => project.id == selectedProjectId) : firstProject;
                var selectedProjectName = selectedProject ? selectedProject.project_name : firstProject.project_name;

                $('#selected-project-name').text(selectedProjectName);
                $('#hover-dropdown-demo .dropdown-toggle div').text(selectedProjectName);

                $.each(response.data, function (index, project) {
                    var projectItem = `
                        <li class="menu-item d-flex flex-row align-items-center justify-content-between">
                            <a class="menu-link" href="#" data-project-id="${project.id}">${project.project_name}</a>
                            <span>
                                <button type="button" class="btn p-0 edit-btn edit-btn-project text-info" data-bs-toggle="modal" data-bs-target="#add-projects-pop" data-project-id="${project.id}" data-project-name="${project.project_name}">
                                    <i class="ti ti-pencil me-1"></i>
                                </button>
                                <button type="button" class="btn p-0 delete-btn text-danger" data-project-id="${project.id}">
                                    <i class="ti ti-trash me-1"></i>
                                </button>
                            </span>
                        </li>`;
                    projectsMenu.append(projectItem);
                });
                if (projectsMenu.children('li').length > 2) {
                    document.cookie.split(";").forEach(function(c) {
                        document.cookie = c.trim().split("=")[0] + '=; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
                    });
                }
            }
        },
        error: function (xhr) {
            console.error('Error fetching projects:', xhr);
        }
    });
}
