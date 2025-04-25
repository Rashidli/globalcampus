document.querySelectorAll('.document-input-box').forEach((box) => {
    const input = box.querySelector('input[type="file"]');
    const fileNameSpan = box.querySelector('.fileName');
    const resetButton = box.querySelector('.resetDocumentBox');

    input?.addEventListener('change', (e) => {
        if (input.files.length > 0) {
            const fileName = input.files[0].name; // Faylın adı
            fileNameSpan.textContent = fileName; // Fayl adını yaz
            if (!box.classList.contains('added-file')) {
                box.classList.add('added-file'); // `added` class-ı əlavə et
            }
        }
    });

    // Reset düyməsinə kliklənəndə
    resetButton?.addEventListener('click', () => {
        input.value = ''; // Fayl seçimini sıfırla
        fileNameSpan.textContent = ''; // Fayl adını sil
        box.classList.remove('added-file'); // `added` class-ını sil
    });
});

document.addEventListener('DOMContentLoaded', () => {
    const documentContainer = document.querySelector('#documentInputs');

    // Check if the container exists before proceeding
    if (documentContainer) {
        // Event delegation for file input changes
        documentContainer.addEventListener('change', (e) => {
            if (e.target && e.target.type === 'file') {
                const box = e.target.closest('.document-input-box');
                const fileNameSpan = box.querySelector('.fileName');

                if (e.target.files.length > 0) {
                    const fileName = e.target.files[0].name; // Get file name
                    fileNameSpan.textContent = fileName; // Display file name
                    box.classList.add('added-file'); // Add `added` class
                }
            }
        });

        // Event delegation for reset button clicks
        documentContainer.addEventListener('click', (e) => {
            if (e.target && e.target.closest('.resetDocumentBox')) {
                const resetButton = e.target.closest('.resetDocumentBox');
                const box = resetButton.closest('.document-input-box');
                const input = box.querySelector('input[type="file"]');
                const fileNameSpan = box.querySelector('.fileName');

                input.value = ''; // Reset file input
                fileNameSpan.textContent = ''; // Clear file name
                box.classList.remove('added-file'); // Remove `added` class
            }
        });
    }
});


const uploadFileBox = document.querySelector('.document-input-item');
if (uploadFileBox) {
  const input = uploadFileBox.querySelector('input[type="file"]');
  const fileNameSpan = uploadFileBox.querySelector('.fileName');

  input?.addEventListener('change', () => {
    if (input.files.length > 0) {
      const fileName = input.files[0].name; // Dosyanın adı
      fileNameSpan.textContent = fileName; // Dosya adını yazdır
      if (!uploadFileBox.classList.contains('added-file')) {
        uploadFileBox.classList.add('added-file'); // `added-file` sınıfını ekle
      }
    }
  });
}


const studentServiceInputs = document.querySelectorAll(".student-service-list .student-service-item .servicePrice input");
const studentCostInputs = document.querySelectorAll(".student-cost-list .student-cost-item .costPrice input");

  const updateWidth = (input) => {
    const valueLength = input.value.length || input.placeholder.length; // Değer veya placeholder uzunluğu
    const newWidth = valueLength*10; // Her karakter için genişlik (örnek: 10px per char)
    input.style.width = `${newWidth}px`; // Genişliği ayarla
  };

  // Her input için event listener ekle
  studentServiceInputs.forEach((input) => {
    input.addEventListener("input", () => updateWidth(input));

    // Sayfa yüklendiğinde genişliği başlangıç için güncelle
    window.addEventListener("DOMContentLoaded", () => updateWidth(input));
  });
  studentCostInputs.forEach((input) => {
    input.addEventListener("input", () => updateWidth(input));

    // Sayfa yüklendiğinde genişliği başlangıç için güncelle
    window.addEventListener("DOMContentLoaded", () => updateWidth(input));
  });

    const student_detail_tabs = document.querySelectorAll(".student-detail-tab");
    const student_detail_tabContents = document.querySelectorAll(".student-tabContent");

    student_detail_tabs.forEach(student_detail_tab => {
            student_detail_tab?.addEventListener("click", () => {
            student_detail_tabs.forEach(tab => tab.classList.remove("active"));
            student_detail_tab.classList.add("active");
            // student_detail_tabContents.forEach(tabContent => tabContent.style.display = "none");
            const id = student_detail_tab.id;
            document.querySelector(`.student-tabContent[data-id="${id}"]`).style.display = "flex";
        });
    });

    const student_general_tabs = document.querySelectorAll(".student_general_tab");
    const student_general_tabContents = document.querySelectorAll(".student_general_tabContent");
    student_general_tabs.forEach(student_general_tab => {
      student_general_tab?.addEventListener("click", () => {
        student_general_tabs.forEach(tab => tab.classList.remove("active"));
        student_general_tab.classList.add("active");

        student_general_tabContents.forEach(tabContent => tabContent.style.display = "none");
            const id = student_general_tab.id;
            document.querySelector(`.student_general_tabContent[data-id="${id}"]`).style.display = "flex";
        });
    });


// const disableStudentBtn = document.querySelector(".disableStudent");
// disableStudentBtn?.addEventListener("click",()=>{
//   disableStudentBtn.classList.toggle("disabled")
// })


const deleteStudentBtn = document.querySelector(".deleteStudent");
const deleteStudentModal = document.querySelector(".deleteStudentModal");
const closeDeleteStudentModal = document.querySelector(".closeDeleteStudentModal");
const deleteStudent_no = document.querySelector(".deleteStudent_no");
deleteStudentBtn?.addEventListener("click",()=>{
  deleteStudentModal.style.display="flex"
})
closeDeleteStudentModal?.addEventListener("click",()=>{
  deleteStudentModal.style.display="none"
})
deleteStudent_no?.addEventListener("click",()=>{
  deleteStudentModal.style.display="none"
})



const uploadStudentDocumentModal = document.querySelector(".uploadStudentDocumentModal");
const closeUploadStudentDocument = document.querySelector(".closeUploadStudentDocument");
const addNewStudentDocument = document.querySelector(".addNewStudentDocument");

closeUploadStudentDocument?.addEventListener("click",()=>{
  uploadStudentDocumentModal.style.display="none"
})
addNewStudentDocument?.addEventListener("click",()=>{
  uploadStudentDocumentModal.style.display="flex"
})

const editStepBtns=document.querySelectorAll(".editStepBtn")
const editStepModal=document.querySelector(".editStepModal")
const closeEditStep=document.querySelector(".closeEditStep")
editStepBtns.forEach(editStepBtn=>{
  editStepBtn?.addEventListener("click",()=>{
    editStepModal.style.display="flex"
  })
})
closeEditStep?.addEventListener("click",()=>{
  editStepModal.style.display="none"
})

const uploadStudentUniversityModal = document.querySelector(".uploadStudentUniversityModal");
const closeUploadStudentUniversity = document.querySelector(".closeUploadStudentUniversity");
const addNewStudentUniversityBtn = document.querySelector(".addNewStudentUniversityBtn");

closeUploadStudentUniversity?.addEventListener("click",()=>{
  uploadStudentUniversityModal.style.display="none"
})
addNewStudentUniversityBtn?.addEventListener("click",()=>{
  uploadStudentUniversityModal.style.display="flex"
})

const editStudentUniversityModal = document.querySelector(".editStudentUniversityModal");
const closeEditStudentUniversity = document.querySelector(".closeEditStudentUniversity");
const editStudentUniversitys = document.querySelectorAll(".editStudentUniversity");

closeEditStudentUniversity?.addEventListener("click",()=>{
  editStudentUniversityModal.style.display="none"
})
editStudentUniversitys.forEach(editStudentUniversity=>{
  editStudentUniversity?.addEventListener("click",()=>{
    editStudentUniversityModal.style.display="flex"
  })
})


const editStudentModal = document.querySelector(".editStudentModal");
const closeEditStudentModal = document.querySelector(".closeEditStudentModal");
// const editInfoBtn = document.querySelector(".editInfoBtn");
//
// closeEditStudentModal?.addEventListener("click",()=>{
//   editStudentModal.style.display="none"
// })
// editInfoBtn?.addEventListener("click",()=>{
//   editStudentModal.style.display="flex"
// })

document.querySelectorAll('.show_password_btn').forEach(button => {
  button?.addEventListener('click', () => {
      const input = button.previousElementSibling;
      if (button.classList.toggle('active')) {
          input.type = 'text';
      } else {
          input.type = 'password';
      }
  });
});


const editAgentModal = document.querySelector(".editAgentModal");
const closeEditAgentModal = document.querySelector(".closeEditAgentModal");
// const agentEdits = document.querySelectorAll(".agentEdit");
const updatePassBtnText = document.querySelector(".updatePassBtnText");
const changesAgentPass = document.querySelector(".changesAgentPass");

closeEditAgentModal?.addEventListener("click",()=>{
  editAgentModal.style.display="none"
    changesAgentPass.style.display="none"
    updatePassBtnText.style.display="block"
})
// agentEdits.forEach(agentEdit=>{
//   agentEdit?.addEventListener("click",()=>{
//     editAgentModal.style.display="flex"
//   })
// })

updatePassBtnText?.addEventListener("click",()=>{
  changesAgentPass.style.display="grid"
  updatePassBtnText.style.display="none"
})

const notificationModalContainer = document.querySelector(".notificationModal-container");
const close_notification = document.querySelector(".close_notification");

close_notification?.addEventListener("click",()=>{
  notificationModalContainer.style.display="none"
})


const editEmployeeModal = document.querySelector(".editEmployeeModal");
const closeEditEmployeeModal = document.querySelector(".closeEditEmployeeModal");
const employeeEdits = document.querySelectorAll(".employeeEdit");

closeEditEmployeeModal?.addEventListener("click",()=>{
  editEmployeeModal.style.display="none"
})
employeeEdits.forEach(employeeEdit=>{
  employeeEdit?.addEventListener("click",()=>{
    editEmployeeModal.style.display="flex"
  })
})

const editServiceModal = document.querySelector(".editServiceModal");
const closeEditServiceModal = document.querySelector(".closeEditServiceModal");
const serviceCategoryEdits = document.querySelectorAll(".serviceCategoryEdit");

closeEditServiceModal?.addEventListener("click",()=>{
  editServiceModal.style.display="none"
})
serviceCategoryEdits.forEach(serviceCategoryEdit=>{
  serviceCategoryEdit?.addEventListener("click",()=>{
    editServiceModal.style.display="flex"
  })
})


const addNewUniversityBtn = document.querySelector(".addNewUniversityBtn");
const addUniversity_Modal= document.querySelector(".addUniversity-Modal");
const closeAddUniversity_Modal = document.querySelector(".closeAddUniversity-Modal");

addNewUniversityBtn?.addEventListener("click",()=>{
  addUniversity_Modal.style.display="flex"
})
closeAddUniversity_Modal?.addEventListener("click",()=>{
  addUniversity_Modal.style.display="none"
})

const universityListEdits = document.querySelectorAll(".universityListEdit");
const editUniversity_Modal= document.querySelector(".editUniversity-Modal");
const closeEditUniversity = document.querySelector(".closeEditUniversity-Modal");

universityListEdits.forEach(btn=>{
  btn?.addEventListener("click",()=>{
    editUniversity_Modal.style.display="flex"
  })
})

closeEditUniversity?.addEventListener("click",()=>{
  editUniversity_Modal.style.display="none"
})


const addServiceModal = document.querySelector(".addServiceModal");
const closeAddServiceModal = document.querySelector(".closeAddServiceModal");
const addNewService = document.querySelector(".addNewService");

closeAddServiceModal?.addEventListener("click",()=>{
  addServiceModal.style.display="none"
})
addNewService?.addEventListener("click",()=>{
  addServiceModal.style.display="flex"
})
const navToggle=document.querySelector(".navToggle")
const menuDropBtns = document.querySelectorAll(".menuDropBtn");
navToggle?.addEventListener("click",()=>{
  navToggle.parentElement.classList.toggle("shortNav")
  menuDropBtns.forEach(btn=>btn.parentElement.classList.remove("activeMenu"))

})
menuDropBtns.forEach(menuDropBtn=>{
  menuDropBtn?.addEventListener("click",()=>{
    navToggle.parentElement.classList.remove("shortNav")
    menuDropBtn.parentElement.classList.toggle("activeMenu")
  })
})


document.querySelectorAll('.university-filter-btn').forEach(menuBtn => {
  menuBtn?.addEventListener('click', () => {
      document.querySelectorAll('.university-filter-item').forEach(dropMenu => {
          if (dropMenu !== menuBtn.parentElement) {
            dropMenu.classList.remove('active');
          }
      });

      // Tıklanan öğenin parent elementine activeDropMenu sınıfını ekleyip kaldırıyoruz (toggle)
      menuBtn.parentElement.classList.toggle('active');
  });
});

const level_tabs = document.querySelectorAll(".level-tab");
const level_tabContents = document.querySelectorAll(".level-tabContent");
  level_tabs.forEach(level_tab => {
    level_tab?.addEventListener("click", () => {
      level_tabs.forEach(tab => tab.classList.remove("active"));
      level_tabContents.forEach(tabContent => tabContent.classList.remove("activeLevelContent"));
      level_tab.classList.add("active")
      const id = level_tab.id;
      document.querySelector(`.level-tabContent[data-id="${id}"]`).classList.add("activeLevelContent");
    });
});

const level_bachelor_tabs = document.querySelectorAll(".level_bachelor_tab");
const bachelor_universities_lists = document.querySelectorAll(".bachelor_universities_lists");
  level_bachelor_tabs.forEach(level_bachelor_tab => {
    level_bachelor_tab?.addEventListener("click", () => {
      level_bachelor_tabs.forEach(tab => tab.classList.remove("active"));
      bachelor_universities_lists.forEach(tabList => tabList.classList.remove("active"));
      level_bachelor_tab.classList.add("active")
      const id = level_bachelor_tab.id;
      document.querySelector(`.bachelor_universities_lists[data-id="${id}"]`).classList.add("active");
    });
});

const level_master_tabs = document.querySelectorAll(".level_master_tab");
const master_universities_lists = document.querySelectorAll(".master_universities_lists");
  level_master_tabs.forEach(level_master_tab => {
    level_master_tab?.addEventListener("click", () => {
      level_master_tabs.forEach(tab => tab.classList.remove("active"));
      master_universities_lists.forEach(tabList => tabList.classList.remove("active"));
      level_master_tab.classList.add("active")
      const id = level_master_tab.id;
      document.querySelector(`.master_universities_lists[data-id="${id}"]`).classList.add("active");
    });
});


const level_phd_tabs = document.querySelectorAll(".level_phd_tab");
const phd_universities_lists = document.querySelectorAll(".phd_universities_lists");
  level_phd_tabs.forEach(level_phd_tab => {
    level_phd_tab?.addEventListener("click", () => {
      level_phd_tabs.forEach(tab => tab.classList.remove("active"));
      phd_universities_lists.forEach(tabList => tabList.classList.remove("active"));
      level_phd_tab.classList.add("active")
      const id = level_phd_tab.id;
      document.querySelector(`.phd_universities_lists[data-id="${id}"]`).classList.add("active");
    });
});

const universities_modal_container = document.querySelector(".universities-modal-container");
const close_universities_modal = document.querySelector(".close-universities-modal");
const addNewUniversitys = document.querySelectorAll(".addNewUniversity");

close_universities_modal?.addEventListener("click",()=>{
  universities_modal_container.style.display="none"
})
addNewUniversitys.forEach(btn=>{
  btn?.addEventListener("click",()=>{
    universities_modal_container.style.display="flex"
  })
})



const fileInputs = document.querySelectorAll('.addUserImg input[type="file"]');

fileInputs.forEach(input => {
  input?.addEventListener('change', function(event) {
    const file = event.target.files[0];
    const img = event.target.previousElementSibling; // input'tan önceki <img> etiketi

    if (file) {
      const reader = new FileReader();
      reader.onload = function(e) {
        img.src = e.target.result;  // img etiketinin src'ini yüklenen dosyaya ayarla
      };
      reader.readAsDataURL(file);
    }
  });
});



const copyBtns = document.querySelectorAll(".infoList .info-list-item .itemDetail .copyBtn");

copyBtns.forEach(copyBtn => {
  copyBtn?.addEventListener("click", () => {
    const text = copyBtn.previousElementSibling.innerText;
    navigator.clipboard.writeText(text)
  });
});

const addUniBoxBtn=document.querySelector(".addUniBoxBtn")
const addUniModal=document.querySelector(".addUniModal")
const closeAddUni=document.querySelector(".closeAddUni")
addUniBoxBtn?.addEventListener("click",()=>{
  addUniModal.style.display="flex"
})
closeAddUni?.addEventListener("click",()=>{
  addUniModal.style.display="none"
})

const addLangBoxBtn=document.querySelector(".addLangBoxBtn")
const addLangModal=document.querySelector(".addLangModal")
const closeAddLang=document.querySelector(".closeAddLang")
addLangBoxBtn?.addEventListener("click",()=>{
  addLangModal.style.display="flex"
})
closeAddLang?.addEventListener("click",()=>{
  addLangModal.style.display="none"
})

const addNewSteps=document.querySelectorAll(".addNewStep")
const addStepModal=document.querySelector(".addStepModal")
const closeAddStep=document.querySelector(".closeAddStep")
addNewSteps.forEach(addNewStep=>{
  addNewStep?.addEventListener("click",()=>{
    addStepModal.style.display="flex"
  })
})
closeAddStep?.addEventListener("click",()=>{
  addStepModal.style.display="none"
})


const editStepBtn_items=document.querySelectorAll(".editStepBtn-item")
const editProgramStepModal=document.querySelector(".editProgramStepModal")
const closeEditProgramStep=document.querySelector(".closeEditProgramStep")
editStepBtn_items.forEach(editStepBtn_item=>{
  editStepBtn_item?.addEventListener("click",()=>{
    editProgramStepModal.style.display="flex"
  })
})
closeEditProgramStep?.addEventListener("click",()=>{
  editProgramStepModal.style.display="none"
})

// const addNewProgram=document.querySelector(".addNewProgram")
const addUniversityModal=document.querySelector(".addUniversityModal")
const closeAddUniversity=document.querySelector(".closeAddUniversity")
// addNewProgram?.addEventListener("click",()=>{
//   addUniversityModal.style.display="flex"
// })
closeAddUniversity?.addEventListener("click",()=>{
  addUniversityModal.style.display="none"
})


const program_item_btns=document.querySelectorAll(".program-item-btn")
program_item_btns.forEach(program_item_btn=>{
  program_item_btn?.addEventListener("click",()=>{
    program_item_btn.parentElement.classList.toggle("active")
  })
})


const editPersonalInfoBtn=document.querySelector(".editPersonalInfoBtn")
const editPersonalInfoModal=document.querySelector(".editPersonalInfo-modal")
const closePersonalInfo=document.querySelector(".closePersonalInfo")
editPersonalInfoBtn?.addEventListener("click",()=>{
  editPersonalInfoModal.style.display="flex"
})
closePersonalInfo?.addEventListener("click",()=>{
  editPersonalInfoModal.style.display="none"
})


const filterToggle=document.querySelector(".filterToggle")
filterToggle?.addEventListener("click",()=>{
  filterToggle.parentElement.parentElement.classList.toggle("short")
})


// const university_tab_btns = document.querySelectorAll(".university-tab-btn");
// const university_tab_contents = document.querySelectorAll(".university-tab-content");
// university_tab_btns.forEach(university_tab_btn => {
//   university_tab_btn?.addEventListener("click", () => {
//     university_tab_btns.forEach(tab => tab.classList.remove("active"));
//     university_tab_contents.forEach(tabList => tabList.style.display="none");
//     university_tab_btn.classList.add("active")
//       const id = university_tab_btn.id;
//       document.querySelector(`.university-tab-content[data-id="${id}"]`).style.display="grid";
//     });
// });
