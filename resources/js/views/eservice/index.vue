<template>
  <div class="app-container">
    <div class="filter-container">
      <el-input
        v-model="query.keyword"
        :placeholder="$t('table.keyword')"
        style="width: 200px"
        class="filter-item"
        clearable
        @keyup.enter.native="handleFilter"
      />
      <el-button
        v-waves
        class="filter-item"
        type="primary"
        icon="el-icon-search"
        @click="handleFilter"
      >{{ $t('table.search') }}</el-button>
      <el-button
        class="filter-item"
        style="margin-left: 10px"
        type="primary"
        icon="el-icon-plus"
        @click="handleCreate"
      >{{ $t('table.add') }}</el-button>
    </div>
    <el-table v-loading="loading" :data="list" style="width: 100%">
      <el-table-column prop="id" label="Id" width="60" />
      <el-table-column prop="name" label="Name" width="150" />
      <el-table-column prop="photo" label="photo" width="150" />
      <el-table-column prop="external_link" label="Link" width="150" />

      <el-table-column label="Operations" width="200">
        <template slot-scope="scope">
          <el-button
            type="danger"
            icon="el-icon-delete"
            @click="handleDelete(scope.row.id)"
            circle
          ></el-button>
        </template>
      </el-table-column>
    </el-table>
    <el-dialog :title="'Create new EService'" :visible.sync="dialogFormVisible">
      <div v-loading="categoryCreating" class="form-container">
        <el-form
          ref="categoryForm"
          :rules="rules"
          :model="eservice"
          label-position="left"
          label-width="150px"
          style="max-width: 500px"
        >
          <el-form-item label="Name" prop="name" required="">
            <el-input v-model="eservice.name" />
          </el-form-item>
          <el-form-item label="Photo" prop="photo" required="">
            <input type="file" name="file" @change="handleChange" required/>
          </el-form-item>
          <el-form-item label="Link" prop="external_link" required="">
            <el-input v-model="eservice.external_link" />
          </el-form-item>
          
        </el-form>
        <div slot="footer" class="dialog-footer">
          <el-button @click="close">{{ $t('table.cancel') }}</el-button>
          <el-button v-if="type === 'create'" type="primary" @click="createCategory">
            {{ $t('table.confirm') }}
          </el-button>
        </div>
      </div>
    </el-dialog>
    <pagination
      v-show="total > 0"
      :total="total"
      :page.sync="query.page"
      :limit.sync="query.limit"
      @pagination="getList"
    />
  </div>
</template>

<script>
import Pagination from '@/components/Pagination';
import Resource from '@/api/resource';
import waves from '@/directive/waves';
import permission from '@/directive/permission';

const eServiceResource = new Resource('eservices');
export default {
  name: 'EServiceList',
  components: { Pagination },
  directives: { waves, permission },
  data() {
    return {
      type: '',
      list: null,
      dialogFormVisible: false,
      categoryCreating: false,
      eservice:{},
      total: 0,
      query: {
        page: 1,
        limit: 15,
        keyword: '',
      },
      imageUrl: null,
      rules: {
        name: [
          {
            required: true,
            message: 'Name is required',
            trigger: blur,
          },
        ],
        external_link: [
          {
            required: true,
            message: 'Photo is required',
            trigger: blur,
          },
        ],
      },
    };
  },
  created() {
    this.getList();
  },
  methods: {
    async getList() {
      const { limit, page } = this.query;
      this.loading = true;
      const { data, meta } = await eServiceResource.list(this.query);
      this.list = data;
      this.list.forEach((element, index) => {
        element['index'] = (page - 1) * limit + index + 1;
      });
      this.loading = false;
    },
    handleCreate(){
      this.type = 'create';
      this.category = {};
      this.dialogFormVisible = true;
      this.$nextTick(() => {
        this.$refs['categoryForm'].clearValidate();
      });
    },
    close() {
      this.dialogFormVisible = false;
      this.Ambassador = {};
    },
    createCategory(){
       let data = new FormData();
      let photo = this.imageUrl;
      data.append('image', photo);
      data.append('name', this.eservice.name);
      data.append('external_link', this.eservice.external_link);
      axios.post('/api/eservices', data).then((response) => {
        this.$message({
              message: 'EService created successfully',
              type: 'success',
              duration: 5 * 1000,
            });
            this.getList();
            this.close();
            this.eService = {};
      });
    },
    handleUpdate(data){
      this.eservice = data;
      this.type = 'edit';
      this.dialogFormVisible = true;
      this.$nextTick(() => {
        this.$refs['categoryForm'].clearValidate();
      });
    },
    handleDelete(id) {
      this.$confirm(
        'This will permanently delete EService ' + name + '. Continue?',
        'Warning',
        {
          confirmButtonText: 'OK',
          cancelButtonText: 'Cancel',
          type: 'warning',
        }
      )
        .then(() => {
          eServiceResource.destroy(id)
            .then((response) => {
              this.$message({
                type: 'success',
                message: 'Delete completed',
              });
              this.getList();
            })
            .catch((error) => {
              console.log(error);
            });
        })
        .catch(() => {
          this.$message({
            type: 'info',
            message: 'Delete canceled',
          });
        });
    },
    handleFilter() {
      this.getList();
    },
    handleChange(e){
      this.imageUrl = e.target.files[0];
    },
  },
};
</script>

<style>
.dialog-footer {
  margin-top: 80px;
}
.avatar-uploader .el-upload {
  border: 1px dashed #d9d9d9;
  border-radius: 6px;
  cursor: pointer;
  position: relative;
  overflow: hidden;
}
.avatar-uploader .el-upload:hover {
  border-color: #409eff;
}
.avatar-uploader-icon {
  font-size: 28px;
  color: #8c939d;
  width: 178px;
  height: 178px;
  line-height: 178px;
  text-align: center;
}
.avatar {
  width: 178px;
  height: 178px;
  display: block;
}
</style>