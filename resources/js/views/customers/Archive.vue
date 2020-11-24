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
      <el-button class="filter-item" type="danger" icon="el-icon-delete" @click="handleDelete">
        {{ $t('table.delete') }}
      </el-button>
    </div>
    <!--Archive-->
    <el-table v-loading="loading" :data="list" border fit highlight-current-row style="width: 100%">
      <el-table-column
        type="selection"
        width="55"
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
      <el-table-column align="center" :label="$t('customer.name')" width="400">
        <template slot-scope="scope">
          <span>{{ scope.row.name }}</span>
        </template>
      </el-table-column>
      <el-table-column align="center" :label="$t('customer.legalname')" width="300">
        <template slot-scope="scope">
          <span>{{ scope.row.legalname }}</span>
        </template>
      </el-table-column>
      <el-table-column align="center" :label="$t('customer.primarycontact')" width="300">
        <template slot-scope="scope">
          <span>{{ scope.row.primarycontact }}</span>
        </template>
      </el-table-column>
      <el-table-column align="center" :label="$t('customer.companyemail')" width="300">
        <template slot-scope="scope">
          <span>{{ scope.row.companyemail }}</span>
        </template>
      </el-table-column>
      <el-table-column align="center" :label="$t('customer.companyphone')" width="400">
        <template slot-scope="scope">
          <span>{{ scope.row.companyphone }}</span>
        </template>
      </el-table-column>
      <el-table-column align="center" :label="$t('customer.secondaryc_name')" width="400">
        <template slot-scope="scope">
          <span>{{ scope.row.secondaryc_name }}</span>
        </template>
      </el-table-column>
      <el-table-column align="center" :label="$t('customer.secondaryc_phone')" width="200">
        <template slot-scope="scope">
          <span>{{ scope.row.secondaryc_phone }}</span>
        </template>
      </el-table-column>
      <el-table-column align="center" :label="$t('customer.secondaryc_email')" width="1000">
        <template slot-scope="scope">
          <span>{{ scope.row.secondaryc_email }}</span>
        </template>
      </el-table-column>
      <el-table-column align="center" :label="$t('customer.accounting_name')" width="200">
        <template slot-scope="scope">
          <span>{{ scope.row.accounting_name }}</span>
        </template>
      </el-table-column>
      <el-table-column align="center" :label="$t('customer.accounting_phone')" width="150">
        <template slot-scope="scope">
          <span>{{ scope.row.accounting_phone }}</span>
        </template>
      </el-table-column>
      <el-table-column align="center" :label="$t('customer.accounting_email')" width="1000">
        <template slot-scope="scope">
          <span>{{ scope.row.accounting_email }}</span>
        </template>
      </el-table-column>
      <el-table-column align="center" :label="$t('customer.fax')">
        <template slot-scope="scope">
          <span>{{ scope.row.fax }}</span>
        </template>
      </el-table-column>
      <el-table-column align="center" :label="$t('customer.deliveryc')" width="200">
        <template slot-scope="scope">
          <span>{{ scope.row.deliveryc }}</span>
        </template>
      </el-table-column>
      <el-table-column align="center" :label="$t('customer.deliverye')" width="1000">
        <template slot-scope="scope">
          <span>{{ scope.row.deliverye }}</span>
        </template>
      </el-table-column>
      <el-table-column align="center" :label="$t('customer.deliveryp')" width="300">
        <template slot-scope="scope">
          <span>{{ scope.row.deliveryp }}</span>
        </template>
      </el-table-column>
      <el-table-column align="center" :label="$t('customer.deliveryday')" width="150">
        <template slot-scope="scope">
          <span>{{ scope.row.rDayOfWeek.name }}</span>
        </template>
      </el-table-column>
      <el-table-column align="center" :label="$t('customer.salesrep')" width="200">
        <template slot-scope="scope">
          <span>{{ scope.row.rContactPerson.firstname + ' ' + scope.row.rContactPerson.lastname }}</span>
        </template>
      </el-table-column>
      <el-table-column align="center" :label="$t('customer.accountmanager')" width="150">
        <template slot-scope="scope">
          <span>{{ scope.row.rAccountManager.name }}</span>
        </template>
      </el-table-column>
      <el-table-column align="center" :label="$t('customer.address1')" width="300">
        <template slot-scope="scope">
          <span>{{ scope.row.address1 }}</span>
        </template>
      </el-table-column>
      <el-table-column align="center" :label="$t('customer.address2')" width="200">
        <template slot-scope="scope">
          <span>{{ scope.row.address2 }}</span>
        </template>
      </el-table-column>
      <el-table-column align="center" :label="$t('customer.city')" width="200">
        <template slot-scope="scope">
          <span>{{ scope.row.city }}</span>
        </template>
      </el-table-column>
      <el-table-column align="center" :label="$t('customer.county')" width="200">
        <template slot-scope="scope">
          <span>{{ scope.row.county }}</span>
        </template>
      </el-table-column>
      <el-table-column align="center" :label="$t('customer.state')" width="200">
        <template slot-scope="scope">
          <span>{{ scope.row.rState.name }}</span>
        </template>
      </el-table-column>
      <el-table-column align="center" :label="$t('customer.zip')" width="200">
        <template slot-scope="scope">
          <span>{{ scope.row.zip }}</span>
        </template>
      </el-table-column>
      <el-table-column align="center" :label="$t('customer.resale')" width="200">
        <template slot-scope="scope">
          <span>{{ scope.row.resale }}</span>
        </template>
      </el-table-column>
      <el-table-column align="center" :label="$t('customer.licensenumber')" width="200">
        <template slot-scope="scope">
          <span>{{ scope.row.licensenumber }}</span>
        </template>
      </el-table-column>
      <el-table-column align="center" :label="$t('customer.companylic')" width="200">
        <template slot-scope="scope">
          <span>{{ scope.row.companylic }}</span>
        </template>
      </el-table-column>
      <el-table-column align="center" :label="$t('customer.licensetype')" width="300">
        <template slot-scope="scope">
          <span>{{ scope.row.rLicenseType.name }}</span>
        </template>
      </el-table-column>
      <el-table-column align="center" :label="$t('customer.licensevalid')" width="200">
        <template slot-scope="scope">
          <span>{{ scope.row.licensevalid }}</span>
        </template>
      </el-table-column>
      <el-table-column align="center" :label="$t('customer.licenseexpire')" width="200">
        <template slot-scope="scope">
          <span>{{ scope.row.licenseexpire }}</span>
        </template>
      </el-table-column>
      <el-table-column align="center" :label="$t('customer.licenseul')" width="300">
        <template slot-scope="scope">
          <span>{{ scope.row.licenseul }}</span>
        </template>
      </el-table-column>
      <el-table-column align="center" :label="$t('customer.sellers_permit')" width="200">
        <template slot-scope="scope">
          <span>{{ scope.row.sellers_permit }}</span>
        </template>
      </el-table-column>
      <el-table-column align="center" :label="$t('customer.website')" width="300">
        <template slot-scope="scope">
          <a :href="scope.row.website" target="_blank">{{ scope.row.website }}</a>
        </template>
      </el-table-column>
      <el-table-column align="center" :label="$t('customer.ein')" width="200">
        <template slot-scope="scope">
          <span>{{ scope.row.ein }}</span>
        </template>
      </el-table-column>
      <el-table-column align="center" :label="$t('customer.terms')" width="200">
        <template slot-scope="scope">
          <span>{{ scope.row.rTerm.name }}</span>
        </template>
      </el-table-column>
      <el-table-column align="center" :label="$t('customer.status')" width="200">
        <template slot-scope="scope">
          <span>{{ scope.row.rStatus.name }}</span>
        </template>
      </el-table-column>
      <el-table-column align="center" :label="$t('customer.servicezone')" width="200">
        <template slot-scope="scope">
          <span>{{ scope.row.servicezone }}</span>
        </template>
      </el-table-column>
      <el-table-column align="center" :label="$t('customer.tags')" width="200">
        <template slot-scope="scope">
          <span>{{ scope.row.tags }}</span>
        </template>
      </el-table-column>
      <el-table-column align="center" :label="$t('customer.notes')" width="100">
        <template slot-scope="scope">
          <el-popover
            placement="top-start"
            title="Note"
            width="300"
            trigger="click"
            :content="scope.row.notes"
          >
            <el-button slot="reference" size="mini">Show</el-button>
          </el-popover>
        </template>
      </el-table-column>
    </el-table>
    <!--./Archive-->
    <!--Pagingation-->
    <pagination v-show="total>0" :total="total" :page.sync="query.page" :limit.sync="query.limit" @pagination="getList" />
    <!--./Pagingation-->

    <!--Form Modal-->
    <el-dialog :title="$t('customer.add_title')" :visible.sync="dialogFormVisible">
      <div v-loading="customerCreating" class="form-container">
        <el-form ref="customerForm" :rules="rules" :model="currentCustomer" label-position="left" label-width="180px">
          <el-form-item :label="$t('customer.name')" prop="name">
            <el-input v-model="currentCustomer.name" />
          </el-form-item>
          <el-form-item :label="$t('customer.legalname')" prop="legalname">
            <el-input v-model="currentCustomer.legalname" />
          </el-form-item>
          <el-form-item :label="$t('customer.primarycontact')" prop="primarycontact">
            <el-input v-model="currentCustomer.primarycontact" />
          </el-form-item>
          <el-form-item :label="$t('customer.companyemail')" prop="companyemail">
            <el-input v-model="currentCustomer.companyemail" />
          </el-form-item>
          <el-form-item :label="$t('customer.companyphone')" prop="companyphone">
            <el-input v-model="currentCustomer.companyphone" />
          </el-form-item>
          <el-form-item :label="$t('customer.secondaryc_name')" prop="secondaryc_name">
            <el-input v-model="currentCustomer.secondaryc_name" />
          </el-form-item>
          <el-form-item :label="$t('customer.secondaryc_phone')" prop="secondaryc_phone">
            <el-input v-model="currentCustomer.secondaryc_phone" />
          </el-form-item>
          <el-form-item :label="$t('customer.secondaryc_email')" prop="secondaryc_email">
            <el-input v-model="currentCustomer.secondaryc_email" />
          </el-form-item>
          <el-form-item :label="$t('customer.accounting_name')" prop="accounting_name">
            <el-input v-model="currentCustomer.accounting_name" />
          </el-form-item>
          <el-form-item :label="$t('customer.accounting_phone')" prop="accounting_phone">
            <el-input v-model="currentCustomer.accounting_phone" />
          </el-form-item>
          <el-form-item :label="$t('customer.accounting_email')" prop="accounting_email">
            <el-input v-model="currentCustomer.accounting_email" />
          </el-form-item>
          <el-form-item :label="$t('customer.fax')" prop="fax">
            <el-input v-model="currentCustomer.fax" />
          </el-form-item>
          <el-form-item :label="$t('customer.deliveryc')" prop="deliveryc">
            <el-input v-model="currentCustomer.deliveryc" />
          </el-form-item>
          <el-form-item :label="$t('customer.deliverye')" prop="deliverye">
            <el-input v-model="currentCustomer.deliverye" />
          </el-form-item>
          <el-form-item :label="$t('customer.deliveryp')" prop="deliveryp">
            <el-input v-model="currentCustomer.deliveryp" />
          </el-form-item>
          <el-form-item :label="$t('customer.deliveryday')" prop="deliveryday">
            <el-select v-model="currentCustomer.deliveryday" class="filter-item" placeholder="Please select Delivery Day">
              <el-option v-for="item in relations.dayOfWeek" :key="item.id" :label="item.day | uppercaseFirst" :value="item.id" />
            </el-select>
          </el-form-item>
          <el-form-item :label="$t('customer.salesrep')" prop="salesrep">
            <el-select v-model="currentCustomer.salesrep" filterable class="filter-item" placeholder="Please select Sales Rep">
              <el-option v-for="item in relations.contactPersons" :key="item.contact_id" :label="item.firstname + ',' + item.lastname" :value="item.contact_id" />
            </el-select>
          </el-form-item>
          <el-form-item :label="$t('customer.accountmanager')" prop="accountmanager">
            <el-select v-model="currentCustomer.accountmanager" filterable class="filter-item" placeholder="Please select Account Manager">
              <el-option v-for="item in relations.contactPersons" :key="item.contact_id" :label="item.firstname + ',' + item.lastname" :value="item.contact_id" />
            </el-select>
          </el-form-item>
          <el-form-item :label="$t('customer.address1')" prop="address1">
            <el-input v-model="currentCustomer.address1" />
          </el-form-item>
          <el-form-item :label="$t('customer.address2')" prop="address2">
            <el-input v-model="currentCustomer.address2" />
          </el-form-item>
          <el-form-item :label="$t('customer.city')" prop="city">
            <el-input v-model="currentCustomer.city" />
          </el-form-item>
          <el-form-item :label="$t('customer.county')" prop="county">
            <el-input v-model="currentCustomer.county" />
          </el-form-item>
          <el-form-item :label="$t('customer.state')" prop="state">
            <el-select v-model="currentCustomer.state" filterable autocomplete="off" class="filter-item" placeholder="Please select State">
              <el-option v-for="item in relations.states" :key="item.state_id" :label="item.abbr" :value="item.state_id" />
            </el-select>
          </el-form-item>
          <el-form-item :label="$t('customer.zip')" prop="zip">
            <el-input v-model="currentCustomer.zip" />
          </el-form-item>
          <el-form-item :label="$t('customer.resale')" prop="resale">
            <el-input v-model="currentCustomer.resale" />
          </el-form-item>
          <el-form-item :label="$t('customer.licensenumber')" prop="licensenumber">
            <el-input v-model="currentCustomer.licensenumber" />
          </el-form-item>
          <el-form-item :label="$t('customer.companylic')" prop="companylic">
            <el-input v-model="currentCustomer.companylic" />
          </el-form-item>
          <el-form-item :label="$t('customer.licensetype')" prop="licensetype">
            <el-select v-model="currentCustomer.licensetype" filterable class="filter-item" placeholder="Please select License Type">
              <el-option v-for="item in relations.licenseTypes" :key="item.type_id" :label="item.name" :value="item.type_id" />
            </el-select>
          </el-form-item>
          <el-form-item :label="$t('customer.licensevalid')" prop="licensevalid">
            <div class="block">
              <el-date-picker
                v-model="currentCustomer.licensevalid"
                type="date"
                format="MM/dd/yyyy"
                value-format="yyyy-MM-dd HH:mm:ss"
                placeholder="Pick a day"
              />
            </div>
          </el-form-item>
          <el-form-item :label="$t('customer.licenseexpire')" prop="licenseexpire">
            <div class="block">
              <el-date-picker
                v-model="currentCustomer.licenseexpire"
                type="date"
                format="MM/dd/yyyy"
                value-format="yyyy-MM-dd HH:mm:ss"
                placeholder="Pick a day"
              />
            </div>
          </el-form-item>
          <el-form-item :label="$t('customer.licenseul')" prop="licenseul">
            <el-upload
              ref="upload"
              class="upload-demo"
              action="#"
              :auto-upload="false"
              :on-change="onFileChange"
              :file-list="fileList"
            >
              <el-button slot="trigger" size="small" type="primary">select file</el-button>
            </el-upload>
          </el-form-item>
          <el-form-item :label="$t('customer.sellers_permit')" prop="sellers_permit">
            <el-input v-model="currentCustomer.sellers_permit" />
          </el-form-item>
          <el-form-item :label="$t('customer.website')" prop="website">
            <el-input v-model="currentCustomer.website" />
          </el-form-item>
          <el-form-item :label="$t('customer.ein')" prop="ein">
            <el-input v-model="currentCustomer.ein" />
          </el-form-item>
          <el-form-item :label="$t('customer.terms')" prop="terms">
            <el-select v-model="currentCustomer.terms" class="filter-item" placeholder="Please select Term">
              <el-option v-for="item in relations.terms" :key="item.term_id" :label="item.term" :value="item.term_id" />
            </el-select>
          </el-form-item>
          <el-form-item :label="$t('customer.status')" prop="status">
            <el-select v-model="currentCustomer.status" class="filter-item" placeholder="Please select Status">
              <el-option v-for="item in relations.status" :key="item.status_id" :label="item.status" :value="item.status_id" />
            </el-select>
          </el-form-item>
          <el-form-item :label="$t('customer.servicezone')" prop="servicezone">
            <el-input v-model="currentCustomer.servicezone" />
          </el-form-item>
          <el-form-item :label="$t('customer.tags')" prop="tags">
            <el-input v-model="currentCustomer.tags" />
          </el-form-item>
          <el-form-item :label="$t('customer.notes')" prop="notes">
            <el-input v-model="currentCustomer.notes" />
          </el-form-item>
        </el-form>
        <div slot="footer" class="dialog-footer">
          <el-button @click="dialogFormVisible = false">
            {{ $t('table.cancel') }}
          </el-button>
          <el-button type="primary" @click="createCustomer()">
            {{ $t('table.confirm') }}
          </el-button>
        </div>
      </div>
    </el-dialog>
    <!--./Form Modal-->
  </div>
</template>
<script>
import CustomerResource from '@/api/customer';
import Pagination from '@/components/Pagination'; // Secondary package based on el-pagination
const customerResource = new CustomerResource();
const msgFieldRquired = 'This field is required.';
export default {
  name: 'CustomerList',
  components: { Pagination },
  data() {
    return {
      list: null,
      total: 0,
      loading: true,
      downloading: false,
      customerCreating: false,
      file: [],
      query: {
        page: 1,
        limit: 10,
        keyword: '',
        role: '',
      },
      relations: {
        contactPersons: [{ contact_id: 1, firstname: 'aa', lastname: 'a' }],
        salesPersons: [{ contact_id: 1, firstname: 'aa', lastname: 'a' }],
        dayOfWeek: [{ id: 1, day: 'aa' }],
        licenseTypes: [{ type_id: 1, name: 'aa' }],
        states: [{ state_id: 1, abbr: 'aa', name: 'aa' }],
        status: [{ status_id: 1, status: 'aa' }],
        term: [{ term_id: 1, term: 'aa' }],
      },
      dialogFormVisible: false,
      currentCustomerId: 0,
      currentCustomer: {},
      fileList: [],
      rules: {
        name: [{ required: true, message: msgFieldRquired, trigger: 'blur' }],
        state: [{ required: true, message: msgFieldRquired, trigger: 'blur' }],
        licensenumber: [{ required: true, message: msgFieldRquired, trigger: 'blur' }],
        terms: [{ required: true, message: msgFieldRquired, trigger: 'blur' }],
      },
    };
  },
  created() {
    this.resetNewCustomer();
    this.getList();
    this.getRelations();
  },
  methods: {
    handleFilter() {
      this.query.page = 1;
      this.getList();
    },
    handleCreate() {
      this.resetNewCustomer();
      this.dialogFormVisible = true;
    },
    handleEdit(index) {
      const customer = this.list[index];
      this.currentCustomer = customer;
      this.dialogFormVisible = true;
      this.currentCustomerId = customer.id;
    },
    handleDelete() {

    },
    onFileChange(file){
      console.log(file);
    },
    async getList() {
      const { limit, page } = this.query;
      this.loading = true;
      const { data, meta } = await customerResource.list(this.query);
      this.list = data;
      this.list.forEach((element, index) => {
        element['index'] = (page - 1) * limit + index + 1;
        element['key'] = index;
      });
      this.total = meta.total;
      this.loading = false;
    },
    async getRelations() {
      const response = await customerResource.relations();
      this.relations = { ...this.realtions, ...response };
      this.relations.salesPersons = this.relations.contactPersons.filter(element => element.contacttype === 3);
    },
    createCustomer() {
      this.$refs['customerForm'].validate((valid) => {
        if (valid) {
          this.userCreating = true;
          if (this.currentCustomerId > 0){
            customerResource
              .update(this.currentCustomerId, this.currentCustomer)
              .then(response => {
                this.$message({
                  message: 'New Customer ' + this.currentCustomer.name + ' has been created successfully.',
                  type: 'success',
                  duration: 5 * 1000,
                });
                this.resetNewCustomer();
                this.dialogFormVisible = false;
                this.getList();
              });
          } else {
            customerResource
              .store(this.currentCustomer)
              .then(response => {
                this.$message({
                  message: 'Customer ' + this.currentCustomer.name + ' has been updated successfully.',
                  type: 'success',
                  duration: 5 * 1000,
                });
                this.resetNewCustomer();
                this.dialogFormVisible = false;
                this.getList();
              });
          }
          // this.resetNewCustomer();
        } else {
          console.log('error submit!!');
          return false;
        }
      });
    },
    resetNewCustomer() {
      this.currentCustomer = {};
      this.currentCustomerId = 0;
    },
  },
};

</script>
<style>
</style>
