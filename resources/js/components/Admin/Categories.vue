<template>
    <div class="container">
        <div class="row pt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Category Table</h3>

                        <div class="card-tools">
                            <button class="btn btn-success" @click="newModal()">
                                Add new
                                <i class="fa fa-plus fa-fw"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Creaed At</th>
                                    <th>Updated At</th>
                                    <th>Modify</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="category in categories"
                                    :key="category.id"
                                >
                                    <td>{{ category.id }}</td>
                                    <td>{{ category.name }}</td>
                                    <td>{{ category.created_at }}</td>
                                    <td>{{ category.updated_at }}</td>
                                    <td>
                                        <a href="#">
                                            <i
                                                class="fa fa-edit text-blue"
                                                @click="editModal(category)"
                                            ></i>
                                        </a>
                                        /
                                        <a href="#">
                                            <i
                                                class="fa fa-trash text-red"
                                                @click="
                                                    deleteCategory(category.id)
                                                "
                                            ></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <div>
                    <paginate
                        :page-count="totalPage"
                        :click-handler="getCategoryPage"
                        :prev-text="'Prev'"
                        :next-text="'Next'"
                        :container-class="'pagination'"
                        :page-class="'page-item'"
                        :page-link-class="'page-link'"
                        :prev-link-class="'page-link'"
                        :next-link-class="'page-link'"
                    ></paginate>
                </div>
                <!-- /.card -->
            </div>
        </div>

        <div
            class="modal fade"
            id="categoryModal"
            tabindex="-1"
            role="dialog"
            aria-labelledby="categoryModal"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            {{ isEdit ? "Edit Category" : "Add new Category" }}
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form
                        @submit.prevent="
                            isEdit ? updateCategory() : createCategory()
                        "
                    >
                        <div class="modal-body">
                            <div class="form-group">
                                <input
                                    v-model="form.name"
                                    type="text"
                                    name="name"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has('name')
                                    }"
                                    placeholder="Name"
                                />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button
                                type="button"
                                class="btn btn-secondary"
                                data-dismiss="modal"
                            >
                                Cancel
                            </button>
                            <button type="submit" class="btn btn-primary">
                                {{ isEdit ? "Update" : "Create" }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            form: new Form({
                id: "",
                name: ""
            }),
            categories: [],
            totalPage: 1,
            isEdit: false
        };
    },
    methods: {
        newModal() {
            this.isEdit = false;
            this.form.reset();
            this.form.clear();
            $("#categoryModal").modal("show");
        },
        editModal(Category) {
            this.isEdit = true;
            this.form.clear();
            this.form.reset();
            $("#categoryModal").modal("show");
            this.form.fill(Category);
        },
        createCategory() {
            this.form.post("api/category").then(({ data }) => {
                $("#categoryModal").modal("hide");
                this.getCategory();
                Toast.fire({
                    icon: "success",
                    title: "Creaed Type in successfully"
                });
            });
        },
        getCategory() {
            this.$Progress.start();
            axios.get("/api/category").then(({ data }) => {
                this.categories = data.categories.data;
                this.totalPage = data.categories.last_page;
            });
            this.$Progress.finish();
        },
        getCategoryPage(page) {
            axios.get("api/Category?page=" + page).then(({ data }) => {
                this.categories = data.categories.data;
                this.totalPage = data.categories.last_page;
            });
        },
        updateCategory() {
            this.form.put("api/category/" + this.form.id).then(() => {
                $("#categoryModal").modal("hide");
                this.getCategory();
                Toast.fire({
                    icon: "success",
                    title: "Updated Category in successfully"
                });
            });
        },
        deleteCategory(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then(result => {
                if (result.value) {
                    axios
                        .delete("api/category/" + id)
                        .then(response => {
                            Swal.fire(
                                "Deleted!",
                                "Product Category has been deleted.",
                                "success"
                            );
                            this.getCategory();
                        })
                        .catch(() => {
                            Swal.fire(
                                "Failed!",
                                "There was something wronge.",
                                "warning"
                            );
                        });
                }
            });
        }
    },
    mounted() {
        this.getCategory();
    }
};
</script>
