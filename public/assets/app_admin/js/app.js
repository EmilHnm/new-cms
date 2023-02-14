"use strict";

const adminPostApp = {
    updateApproved: (e, id) => {
        e.target.disabled = true;
        fetch("https://cms.com/admin/posts/update/approver?id=" + id)
            .then((res) => res.json())
            .then((data) => {
                e.target.disabled = false;
                if (data.status == "success")
                    toastr.success(
                        `Update approvor of post with id ${id} successfully`
                    );
            });
    },
};

const roleSelect = document.getElementById("role");
const permissionCheckboxes = document.querySelectorAll(
    'input[type="checkbox"]'
);
const permissionCheckboxesArray = Array.from(permissionCheckboxes);

const adminUserApp = {
    abortController: null,
    signal: null,
    setRolePermission: (e) => {
        if (permissionCheckboxesArray.length == 0) return;
        let selectedRole = e.target.value;
        if (this.abortController) {
            this.abortController.abort();
            this.abortController = new AbortController();
        } else {
            this.abortController = new AbortController();
        }
        this.signal = this.abortController.signal;
        fetch(`https://cms.com/admin/roles/permissions?role=${selectedRole}`, {
            method: "GET",
            signal: signal,
        })
            .then((response) => response.json())
            .then((data) => {
                permissionCheckboxesArray.forEach((node) => {
                    if (data.includes(parseInt(node.value))) {
                        node.checked = true;
                        node.disabled = true;
                    } else {
                        node.checked = false;
                        node.disabled = false;
                    }
                });
            });
    },
};

document.addEventListener("DOMContentLoaded", () => {
    if (roleSelect) {
        let selectedRole = roleSelect.value;
        if (selectedRole)
            fetch(
                `https://cms.com/admin/roles/permissions?role=${selectedRole}`,
                {
                    method: "GET",
                }
            )
                .then((response) => response.json())
                .then((data) => {
                    permissionCheckboxesArray.forEach((node) => {
                        if (data.includes(parseInt(node.value))) {
                            node.checked = true;
                            node.disabled = true;
                        } else {
                            node.checked = false;
                            node.disabled = false;
                        }
                    });
                });
    }
});
