



document.addEventListener("DOMContentLoaded", function () {

    const disableButton = document.querySelector('.disableStudent');

    if (disableButton) {
        disableButton.addEventListener('click', function () {
            const userId = disableButton.dataset.userId;

            // Send AJAX request to toggle the status
            fetch(`/user/${userId}/toggle-status`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token
                },
                body: JSON.stringify({
                    user_id: userId
                })
            })
                .then(response => response.json())
                .then(data => {
                    console.log('User status updated:', data.status);
                    location.reload();
                })
                .catch(error => {
                    console.error('Error toggling status:', error);
                });
        });
    }

    const addButton1 = document.querySelector('.addStudentCost');
    const costList = document.querySelector('.student-cost-list');

    if (addButton1) {
        addButton1.addEventListener('click', function () {
            const newCostItem = document.createElement('div');
            newCostItem.classList.add('student-cost-item');
            newCostItem.innerHTML = `
            <select name="reason[]" id="">
                <option value="">Seç</option>
                <option value="sebeb1">sebeb1</option>
                <option value="sebeb2">sebeb2</option>
                <option value="sebeb3">sebeb3</option>
                <option value="sebeb4">sebeb4</option>
            </select>
            <div class="costPrice">
                <input type="text" name="price[]" placeholder="0">
                <span>AZN</span>
            </div>
            <button class="deleteCostService" type="button">
                <img src="/assets/images/trash.svg" alt="">
            </button>
        `;
            costList.appendChild(newCostItem);
            $(newCostItem).find('select').niceSelect();
            // Attach delete functionality
            newCostItem.querySelector('.deleteCostService').addEventListener('click', function () {
                newCostItem.remove();
            });
        });
    }

    // Attach delete functionality to existing buttons
    document.querySelectorAll('.deleteCostService').forEach(button => {
        button.addEventListener('click', function () {
            button.parentElement.remove();
        });
    });


    const addButton = document.getElementById('addStudentService');
    const serviceList = document.getElementById('studentServiceList');

    // Function to generate service options
    function generateServiceOptions() {
        let options = '<option value="">Seç</option>';
        services.forEach(service => {
            options += `<option value="${service.id}">${service.title}</option>`;
        });
        return options;
    }

    if (addButton) {
        addButton.addEventListener('click', function () {
            const newServiceItem = document.createElement('div');
            newServiceItem.classList.add('student-service-item');
            newServiceItem.innerHTML = `
            <select name="service_id[]">
                ${generateServiceOptions()}
            </select>
            <div class="servicePrice">
                <input type="text" name="price[]" placeholder="0">
                <span>AZN</span>
            </div>
            <button class="deleteStudentService" type="button">
                <img src="${window.location.origin}/assets/images/trash.svg" alt="">
            </button>
        `;

            serviceList.appendChild(newServiceItem);
            $(newServiceItem).find('select').niceSelect();
            // Attach delete functionality to the new button
            newServiceItem.querySelector('.deleteStudentService').addEventListener('click', function () {
                newServiceItem.remove();
            });
        });
    }

    // Attach delete functionality to existing buttons
    document.querySelectorAll('.deleteStudentService').forEach(button => {
        button.addEventListener('click', function () {
            button.parentElement.remove();
        });
    });

// Education plus minus started
    const educationFormsContainer = document.getElementById("educationFormsContainer");
    const addEducationButton = document.getElementById("addEducation");

// Function to initialize the delete functionality for all delete buttons
    function initializeDeleteButtons() {
        document.querySelectorAll(".deleteInfoForm").forEach((deleteButton) => {
            deleteButton.addEventListener("click", function () {
                // Find the closest .form-items to the clicked delete button
                const formToDelete = this.previousElementSibling;
                // Remove the individual form item
                formToDelete.remove();
                this.remove()
            });
        });
    }

// Add event listener for dynamically added education forms
    addEducationButton.addEventListener("click", () => {
        const newEducationForm = document.createElement("div");
        newEducationForm.classList.add("educationFormLine");

        newEducationForm.innerHTML = `
    <div class="form-items">
        <div class="form-item">
            <label for="">Təhsil dərəcəsi</label>
            <select name="degree[]">
                <option value="">Seç</option>
                <option value="Bakalavr">Bakalavr</option>
                <option value="Magistratura">Magistratura</option>
                <option value="Phd">Phd</option>
                <option value="Rezidentura">Rezidentura</option>
            </select>
        </div>
        <div class="form-item">
            <label for="">Universitetin adı</label>
            <input type="text" name="university[]" placeholder="Universitetin adı">
        </div>
        <div class="form-item">
            <label for="">Fakültə adı</label>
            <input type="text" name="faculty[]" placeholder="Fakültənin adı">
        </div>
        <div class="form-item">
            <label for="">İxtisas adı</label>
            <input type="text" name="profession[]" placeholder="İxtisasın adı">
        </div>
        <div class="form-item">
            <label for="">GNO</label>
            <input type="text" name="gno[]" placeholder="GNO">
        </div>
        <div class="form-item">
            <label for="">Başlama tarixi</label>
            <input type="date" name="start_date[]" placeholder="Ay/İl">
        </div>
        <div class="form-item">
            <label for="">Bitmə tarixi</label>
            <input type="date" name="end_date[]" placeholder="Ay/İl">
        </div>
    </div>
    <button type="button" class="deleteInfoForm deleteEducation">
        <img src="${assetBasePath}assets/images/trash.svg" alt="">
        Sil
    </button>
`;

        // Append the new education form to the container
        educationFormsContainer.appendChild(newEducationForm);

        // Initialize delete functionality for the newly added form
        initializeDeleteButtons();

        // Initialize niceSelect for the new select elements
        $(newEducationForm).find('select').niceSelect();
    });

// Initialize delete buttons for existing forms
    initializeDeleteButtons();
// Education plus minus ended


    const workExperienceContainer = document.querySelector(".workExperienceLine");
    const addWorkExperienceButton = document.querySelector(".workExperienceInfoForm .addInfoForm");

    addWorkExperienceButton.addEventListener("click", () => {
        const newWorkExperience = document.createElement("div");
        newWorkExperience.classList.add("workExperienceLine");

        newWorkExperience.innerHTML = `
            <div class="form-items">
                <div class="form-item-left">
                    <div class="form-item">
                        <label for="">İş yeri</label>
                        <input type="text" name="experience_company[]" placeholder="Müəssisənin adı">
                    </div>
                    <div class="form-item">
                        <label for="">Vəzifə</label>
                        <input type="text" name="position[]" placeholder="Vəzifənin  adı">
                    </div>
                </div>
                <div class="form-item-right">
                    <div class="form-item">
                        <label for="">Başlama tarixi</label>
                        <input type="date" name="experience_start_date[]" placeholder="Ay/İl">
                    </div>
                    <div class="form-item">
                        <label for="">Bitmə tarixi</label>
                        <input type="date" name="experience_end_date[]" placeholder="Ay/İl">
                    </div>
                </div>
            </div>
            <button class="deleteInfoForm">
                <img src="${assetBasePath}assets/images/trash.svg" alt="">
                Sil
            </button>
        `;

        newWorkExperience.querySelector(".deleteInfoForm").addEventListener("click", function () {
            newWorkExperience.remove();
        });

        workExperienceContainer.appendChild(newWorkExperience);
    });


    // Language Skills Section
    const languageSkillsContainer = document.querySelector(".languageSkillsInfoForm"); // Changed to the parent container
    const addLanguageSkillsButton = document.querySelector(".languageSkillsInfoForm .addInfoForm");

    addLanguageSkillsButton.addEventListener("click", () => {
        const newLanguageSkill = document.createElement("div");
        newLanguageSkill.classList.add("languageSkillsLine");

        newLanguageSkill.innerHTML = `
        <div class="form-items">
            <div class="form-item">
                <label for="">Dil</label>
                <select name="language[]">
                    <option value="">Seçin</option>
                    <option value="English">English</option>
                    <option value="Russian">Russian</option>
                    <option value="Spanish">Spanish</option>
                    <option value="Turkish">Turkish</option>
                </select>
            </div>
            <div class="form-item">
                <label for="">Bilik səviyyəniz</label>
                <select name="level[]">
                    <option value="">Seçin</option>
                    <option value="Advanced">Advanced</option>
                    <option value="Intermediate">Intermediate</option>
                    <option value="Pre-Intermediate">Pre-Intermediate</option>
                    <option value="Beginner">Beginner</option>
                </select>
            </div>
        </div>
        <button class="deleteInfoForm">
            <img src="${assetBasePath}assets/images/trash.svg" alt="">
            Sil
        </button>
    `;

        newLanguageSkill.querySelector(".deleteInfoForm").addEventListener("click", function () {
            newLanguageSkill.remove();
        });

        languageSkillsContainer.insertBefore(newLanguageSkill, addLanguageSkillsButton);
        $(newLanguageSkill).find('select').niceSelect();
    });


    // Programs Information Section
    const programsContainer = document.querySelector(".programsLine");
    const addProgramButton = document.querySelector(".programsInfoForm .addInfoForm");

    addProgramButton.addEventListener("click", () => {
        const newProgram = document.createElement("div");
        newProgram.classList.add("programsLine");

        newProgram.innerHTML = `
    <div class="form-items">
        <div class="form-item">
            <label for="">Proqramı seç</label>
            <select name="program_education[]">
                <option value="">Seçin</option>
                <option value="Bakalavr">Bakalavr</option>
                <option value="Magistr">Magistr</option>
                <option value="Doktorantura">Doktorantura</option>
            </select>
        </div>
        <div class="form-items-right">
            <div class="form-item">
                <label for="">Ölkə</label>
                <input type="text" name="country[]" placeholder="Ölkə">
            </div>
            <div class="form-item">
                <label for="">Universitet</label>
                <input type="text" name="program_university[]" placeholder="Universitet">
            </div>
            <div class="form-item">
                <label for="">İxtisas</label>
                <input type="text" name="program_profession[]" placeholder="İxtisas">
            </div>
            <div class="form-item">
                <label for="">Müqavilənin başlayacağı tarix</label>
                <input type="date" name="program_date[]" placeholder="Gün/Ay/İl" class="datepicker">
            </div>
            <div class="form-item">
                <label for="">Dönəm</label>
                <select name="donem[]">
                    <option value="">Seçin</option>
                    <option value="guz">Güz</option>
                    <option value="bahar">Bahar</option>
                </select>
            </div>
            <div class="form-item">
                <label for="">Dönəm tarixi</label>
                <div class="form-item-selects">
                    <select name="donem_start[]">
                        <option value="">Başlama ili</option>
                        ${generateYearOptions(2019, 2026)}
                    </select>
                    <select name="donem_end[]">
                        <option value="">Bitmə ili</option>
                        ${generateYearOptions(2019, 2026)}
                    </select>
                </div>
            </div>
        </div>
    </div>
    <button class="deleteInfoForm">
        <img src="${assetBasePath}assets/images/trash.svg" alt="">
        Sil
    </button>
`;

// Function to generate year options dynamically
        function generateYearOptions(start, end) {
            let options = '';
            for (let year = start; year <= end; year++) {
                options += `<option value="${year}">${year}</option>`;
            }
            return options;
        }


        newProgram.querySelector(".deleteInfoForm").addEventListener("click", function () {
            newProgram.remove();
        });

        programsContainer.appendChild(newProgram);
        $(programsContainer).find('select').niceSelect();
    });


});
