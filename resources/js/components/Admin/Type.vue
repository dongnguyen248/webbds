<template>
<div class="container">
    <div class="row pt-5">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Product Type Table</h3>

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
                                <th>Category</th>
                                <th>Name</th>
                                <th>Creaed At</th>
                                <th>Updated At</th>
                                <th>Modify</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="type in Type" :key="type.id">
                                <td>{{ type.id }}</td>
                                <td>{{ type.category.name }}</td>
                                <td>{{ type.name  }}</td>
                                <td>{{ type.created_at }}</td>
                                <td>{{ type.updated_at }}</td>
                                <td>
                                    <a href="#">
                                        <i class="fa fa-edit text-blue" @click="editModal(type)"></i>
                                    </a>
                                    /
                                    <a href="#">
                                        <i class="fa fa-trash text-red" @click="
                                                    deleteProductType(
                                                        type.id
                                                    )
                                                "></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <div>
                <paginate class="paginate" :page-count="totalPage" :click-handler="getProductTypePage" :prev-text="'Prev'" :next-text="'Next'" :container-class="'pagination'" :page-class="'page-item'" :page-link-class="'page-link'" :prev-link-class="'page-link'" :next-link-class="'page-link'"></paginate>
            </div>
            <!-- /.card -->
        </div>
    </div>

    <div class="modal fade" id="productTypeModal" tabindex="-1" role="dialog" aria-labelledby="productTypeModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        {{
                                isEdit
                                    ? "Edit Product Type"
                                    : "Add new Product Type"
                            }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit.prevent="
                            isEdit ? updateProductType() : createProductType()
                        ">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="group" class="col-form-label">Category:</label>
                            <select v-model="form.category_id" name="type" class="form-control">
                                <option value="none" selected>Select Category</option>
                                <option v-for="category in Categories" :key="category.id" :value="category.id">{{ category.name }}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-form-label">Type name:</label>
                            <input v-model="form.name" type="text" name="name" class="form-control" :class="{
                                        'is-invalid': form.errors.has('name')
                                    }" placeholder="Name" />
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-form-label">Ảnh :</label>
                            <input type="file" hidden id="picture" class="form-control" @change="chooseFile" accept="image/*" placeholder="Ảnh học viên nếu có " />
                            <label for="picture" class="form-control">{{form.photo}}</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
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
                name: "",
                photo:'',
                image: "",
                category_id: ""
            }),
            Type: [],
            Categories: [],
            totalPage: 1,
            isEdit: false,
        }
    },
    methods: {
        newModal() {
            this.isEdit = false;
            this.form.reset();
            this.form.clear();
            $("#productTypeModal").modal("show");
        },
        editModal(type) {
            this.isEdit = true;
            this.form.clear();
            this.form.reset();
            $("#productTypeModal").modal("show");
            this.form.fill(type);
        },
        createProductType() {
            
            const formdata = new FormData();
            formdata.set('name',this.form.name);
            formdata.set('image',this.form.image);
            formdata.set('category_id',this.form.category_id);
            axios.post("api/type",formdata).then(({
                data
            }) => {
                $("#productTypeModal").modal("hide");
                this.getProductType();
                Toast.fire({
                    icon: "success",
                    title: "Creaed Type in successfully"
                });
            });
        },
        chooseFile(event) {
            this.form.image = event.target.files[0];
            let filename = event.target.files[0].name;
            if (!filename.match(/.(jpg|jpeg|png|gif)$/i))
                return this.Swal("This file is not iamge please choose image file");
            this.form.photo = filename;

        },
        getProductType() {
            this.$Progress.start();
            axios.get("api/type").then(({
                data
            }) => {
                this.Type = data.type.data;
                this.totalPage = data.type.last_page;
            });
            this.$Progress.finish();
        },
        getProductTypePage(page) {
            axios.get("api/type?page=" + page).then(({
                data
            }) => {
                this.Type = data.type.data;
                this.totalPage = data.type.last_page;
            });
        },
        updateProductType() {
            this.form.put("api/type/" + this.form.id).then(() => {
                $("#productTypeModal").modal("hide");
                this.getProductType();
                Toast.fire({
                    icon: "success",
                    title: "Updated Type in successfully"
                });
            });
        },
        deleteProductType(id) {
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
                        .delete("api/type/" + id)
                        .then(response => {
                            Swal.fire(
                                "Deleted!",
                                "Product Type has been deleted.",
                                "success"
                            );
                            this.getProductType();
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
        },
        
    },
    mounted() {
        this.getProductType();
    }
};
</script>
