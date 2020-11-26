<template>
  <div class="app-container">
    <!--Top Bar-->
    <div class="filter-container">
      <el-input v-model="query.keyword" :placeholder="$t('table.keyword')" style="width: 200px;" class="filter-item" @keyup.enter.native="handleFilter" />
      <el-button class="filter-item" style="margin-left: 10px;" type="primary" icon="el-icon-plus" @click="handleCreate">
        {{ $t('table.add') }}
      </el-button>
      <el-button class="filter-item" type="primary" icon="el-icon-download">
        {{ $t('table.export') }}
      </el-button>
    </div>
    <!--Archive-->
    <el-table v-loading="loading" :data="list" border fit highlight-current-row style="width: 100%">
      <el-table-column
        type="selection"
        width="40"
      />
      <el-table-column align="center" label="Actions" width="100">
        <template slot-scope="scope">
          <el-button type="primary" size="mini" icon="el-icon-edit" @click="handleEdit(scope.row.key)">
            {{ $t('customer.edit') }}
          </el-button>
        </template>
      </el-table-column>
      <el-table-column align="center" label="ID" width="80">
        <template slot-scope="scope">
          <span>{{ scope.row.index }}</span>
        </template>
      </el-table-column>
      <el-table-column align="center" label="Firstname" width="150">
        <template slot-scope="scope">
          <span>{{ scope.row.firstname }}</span>
        </template>
      </el-table-column>
      <el-table-column align="center" label="lastname" width="150">
        <template slot-scope="scope">
          <span>{{ scope.row.lastname }}</span>
        </template>
      </el-table-column>
      <el-table-column align="center" :label="$t('contactPerson.telephone')" width="150">
        <template slot-scope="scope">
          <span>{{ scope.row.telephone }}</span>
        </template>
      </el-table-column>
      <el-table-column align="center" :label="$t('contactPerson.email')" width="200">
        <template slot-scope="scope">
          <span>{{ scope.row.email }}</span>
        </template>
      </el-table-column>
      <el-table-column align="center" :label="$t('contactPerson.address1')" width="300">
        <template slot-scope="scope">
          <span>{{ scope.row.address1 }}</span>
        </template>
      </el-table-column>
      <el-table-column align="center" :label="$t('contactPerson.address2')" width="300">
        <template slot-scope="scope">
          <span>{{ scope.row.address2 }}</span>
        </template>
      </el-table-column>
      <el-table-column align="center" :label="$t('contactPerson.city') | uppercaseFirst" width="100">
        <template slot-scope="scope">
          <span>{{ scope.row.city }}</span>
        </template>
      </el-table-column>
      <el-table-column align="center" :label="$t('contactPerson.state') | uppercaseFirst" width="100">
        <template slot-scope="scope">
          <span>{{ scope.row.rState.name }}</span>
        </template>
      </el-table-column>
      <el-table-column align="center" :label="$t('contactPerson.zip') | uppercaseFirst" width="100">
        <template slot-scope="scope">
          <span>{{ scope.row.zip }}</span>
        </template>
      </el-table-column>
      <el-table-column align="center" :label="$t('contactPerson.contacttype') | uppercaseFirst" width="250">
        <template slot-scope="scope">
          <span>{{ scope.row.rContactType.name }}</span>
        </template>
      </el-table-column>
      <el-table-column align="center" :label="$t('contactPerson.uppermanage') | uppercaseFirst" width="200">
        <template slot-scope="scope">
          <span>{{ scope.row.rUpperManage }}</span>
        </template>
      </el-table-column>
      <el-table-column align="center" :label="$t('contactPerson.region') | uppercaseFirst" width="500">
        <template slot-scope="scope">
          <span>{{ scope.row.region }}</span>
        </template>
      </el-table-column>
    </el-table>
    <!--./Archive-->
    <!--Pagingation-->
    <pagination v-show="total>0" :total="total" :page.sync="query.page" :limit.sync="query.limit" @pagination="getList" />
    <!--./Pagingation-->
    <!--Dialog-->
    <el-dialog :title="$t('contactPerson.addTitle')" :visible.sync="bDialogFormVisible">
      <div v-loading="bCreating" class="form-container">
        <el-form ref="form" :rules="rules" :model="currentRecord" label-position="left" label-width="180px">
          <el-form-item :label="$t('contactPerson.firstname')" prop="firstname">
            <el-input v-model="currentRecord.firstname" />
          </el-form-item>
          <el-form-item :label="$t('contactPerson.lastname')" prop="lastname">
            <el-input v-model="currentRecord.lastname" />
          </el-form-item>
          <el-form-item :label="$t('contactPerson.telephone')" prop="telephone">
            <el-input v-model="currentRecord.telephone" />
          </el-form-item>
          <el-form-item :label="$t('contactPerson.email')" prop="email">
            <el-input v-model="currentRecord.email" />
          </el-form-item>
          <el-form-item :label="$t('contactPerson.address1')" prop="address1">
            <el-input v-model="currentRecord.address1" />
          </el-form-item>
          <el-form-item :label="$t('contactPerson.address2')" prop="address2">
            <el-input v-model="currentRecord.address2" />
          </el-form-item>
          <el-form-item :label="$t('contactPerson.city')" prop="city">
            <el-input v-model="currentRecord.city" />
          </el-form-item>
          <el-form-item :label="$t('contactPerson.state')" prop="state">
            <el-select v-model="currentRecord.state" class="filter-item" :placeholder="$t('common.selectLabel') + $t('contactPerson.state')">
              <el-option v-for="item in relations.states" :key="item.state_id" :label="item.abbr | uppercaseFirst" :value="item.state_id" />
            </el-select>
          </el-form-item>
          <el-form-item :label="$t('contactPerson.zip')" prop="zip">
            <el-input v-model="currentRecord.zip" />
          </el-form-item>
          <el-form-item :label="$t('contactPerson.contacttype')" prop="contacttype">
            <el-select v-model="currentRecord.contacttype" class="filter-item" :placeholder="$t('common.selectLabel') + $t('contactPerson.contacttype')">
              <el-option v-for="item in relations.contactTypes" :key="item.ct_id" :label="item.type | uppercaseFirst" :value="item.ct_id" />
            </el-select>
          </el-form-item>
          <el-form-item :label="$t('contactPerson.uppermanage')" prop="uppermanage">
            <el-select v-model="currentRecord.uppermanage" class="filter-item" :placeholder="$t('common.selectLabel') + $t('contactPerson.uppermanage')">
              <el-option :key="upperManageYes" label="Yes" :value="upperManageYes" />
              <el-option :key="upperManageNo" label="No" :value="upperManageNo" />
            </el-select>
          </el-form-item>
          <el-form-item :label="$t('contactPerson.region')" prop="region">
            <el-input v-model="currentRecord.region" />
          </el-form-item>
        </el-form>
        <div slot="footer" class="dialog-footer">
          <el-button @click="bDialogFormVisible = false">
            {{ $t('table.cancel') }}
          </el-button>
          <el-button type="primary" @click="createRecord()">
            {{ $t('table.confirm') }}
          </el-button>
        </div>
      </div>
    </el-dialog>
    <!--./Dialog-->
  </div>
</template>
<script>
import ArchiveResource from '@/api/contact-person';
import Pagination from '@/components/Pagination'; // Secondary package based on el-pagination
const archiveResource = new ArchiveResource();
const msgFieldRquired = 'This field is required.';
export default {
  name: 'ContactPersonList',
  components: { Pagination },
  data() {
    return {
      list: null,
      total: 0,
      query: {
        page: 1,
        limit: 10,
        keyword: '',
        role: '',
      },
      relations: {
        states: [{ state_id: 1, abbr: 'FA' }],
        contactTypes: [{ ct_id: 1, type: 's' }],
      },
      currentRecord: {},
      bCreating: false,
      upperManageYes: 1,
      upperManageNo: 0,
      bDialogFormVisible: false,
      rules: {
        firstname: [{ required: true, message: msgFieldRquired, trigger: 'blur' }],
        lastname: [{ required: true, message: msgFieldRquired, trigger: 'blur' }],
      },
    };
  },
  created() {
    this.resetCurrentRecord();
    this.getList();
    this.getRelations();
  },
  methods: {
    handleFilter() {
      this.query.page = 1;
    },
    handleCreate() {
      this.resetCurrentRecord();
      this.bDialogFormVisible = true;
    },
    handleEdit(key) {
      this.currentRecord = this.list[key];
      this.bDialogFormVisible = true;
    },
    async getList() {
      const { limit, page } = this.query;
      this.loading = true;
      const { data, meta } = await archiveResource.list(this.query);
      this.list = data;
      this.list.forEach((element, index) => {
        element['index'] = (page - 1) * limit + index + 1;
        element['key'] = index;
      });
      this.total = meta.total;
      this.loading = false;
    },
    async getRelations() {
      const response = await archiveResource.relations();
      this.relations = { ...this.realtions, ...response };
    },
    resetCurrentRecord() {
      this.currentRecord = {};
      this.bCreating = false;
    },
    createRecord() {
      this.$refs['form'].validate((valid) => {
        if (valid) {
          this.bCreating = true;
          if (this.currentRecord.contact_id > 0) {
            archiveResource
              .update(this.currentRecord.contact_id, this.currentRecord)
              .then(response => {
                this.$message({
                  message: 'New Contact Person ' + response.firstname + ' ' + response.lastname + ' has been created successfully.',
                  type: 'success',
                  duration: 5 * 1000,
                });
                this.resetCurrentRecord();
                this.bDialogFormVisible = false;
                this.getList();
              })
              .catch(error => {
                console.log(error);
              })
              .finally(() => {
                this.bCreating = false;
              });
          } else {
            archiveResource
              .store(this.currentRecord)
              .then(response => {
                this.$message({
                  message: 'Contact Person ' + response.firstname + ' ' + response.lastname + ' has been updated successfully.',
                  type: 'success',
                  duration: 5 * 1000,
                });
                this.resetCurrentRecord();
                this.bDialogFormVisible = false;
                this.getList();
              })
              .catch(error => {
                console.log(error);
              })
              .finally(() => {
                this.bCreating = false;
              });
          }
        }
      });
      this.bDialogFormVisible = false;
    },
  },
};
</script>
