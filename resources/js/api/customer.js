import Resource from '@/api/resource';
import request from '@/utils/request';

class CustomerResource extends Resource {
  constructor() {
    super('customers');
  }

  relations() {
    return request({
      url: '/' + this.uri + '/relations',
      method: 'get',
    });
  }
}

export { CustomerResource as default };
