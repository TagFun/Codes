(function() {
    var.customersService = function () {
        var customers = [ 
            {
                id: 1,
                joined: '2002-12-02', 
                name: 'John', 
                city: 'Chandler', 
                orderTotal: 9.9956,
                orders: [ 
                    {
                        id: 1,
                        product: 'Shoes',
                        total: 9.9956
                    }
                ]
            },
            {
                id: 2,
                joined: '1965-01-25', 
                name: 'Zed', 
                city: 'Las Vegas', 
                orderTotal: 19.99,
                orders: [ 
                    {
                        id: 2,
                        product: 'Shirt',
                        total: 10.7846
                    },
                    {
                        id: 3,
                        product: 'Bat',
                        total: 4.7842
                    }
                ]
            },
            {
                id: 3,
                joined: '1944-06-15', 
                name: 'Tina', 
                city: 'New York', 
                orderTotal: 44.99,
                orders: [
                    {
                        id: 4,
                        product: 'Jeans',
                        total: 25.7518
                    }
                ]
            },
            {
                id: 4,
                joined: '1995-03-28', 
                name: 'Dave', 
                city: 'Seattle', 
                orderTotal: 101.5,
                orders: [
                    {
                        id: 5,
                        product: 'Hat',
                        total: 4.5445
                    }
                ]
            }
        ];

        this.getCustomers = function() {
            return customers;
        };
        
        this.getCustomer = function(customerId) {
            for (var i=0,len=customers.length;i<len;i++) {
                if (customers[i].id === parseInt(customerId)) {
                    return customers[i];
                }
            }
            
            return {};
        };
              
    };

    angular.module('customersApp').service('customersService', customersService);

}());