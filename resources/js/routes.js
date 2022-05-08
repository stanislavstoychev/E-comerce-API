let login = require('./components/auth/login.vue').default;
let register = require('./components/auth/register.vue').default;
let logout = require('./components/auth/logout.vue').default;
let forget = require('./components/auth/forget.vue').default;
let home = require('./components/home.vue').default;


// Empoyee Component
let storeemployee = require('./components/employee/create.vue').default;
let employee = require('./components/employee/index.vue').default;
let editemployee = require('./components/employee/edit.vue').default;

//expense
let storeexpense = require('./components/expense/create.vue').default;
let expense = require('./components/expense/index.vue').default;
let editexpense = require('./components/expense/edit.vue').default;

//drawing
let storetransmittal = require('./components/drawing/createtransmittal.vue').default;
let storedrawing = require('./components/drawing/createdrawing.vue').default;
transmittaledit

let transmittaledit = require('./components/drawing/transmittaledit.vue').default;
let transmittalidex = require('./components/drawing/transmittalindex.vue').default;
let transmittaldetails = require('./components/drawing/transmittaldetails.vue').default;
let drawingindex = require('./components/drawing/index.vue').default;
let drawing = require('./components/drawing/drawing.vue').default;
let editdrawing = require('./components/drawing/edit.vue').default;
let editattachdrawing = require('./components/drawing/editattach.vue').default;

//issue
let storeissue = require('./components/issue/create.vue').default;
let issue = require('./components/issue/index.vue').default;
let issueall = require('./components/issue/indexall.vue').default;
let editissue = require('./components/issue/edit.vue').default;
let attachissue = require('./components/issue/attach.vue').default;
let editattachissue = require('./components/issue/editattach.vue').default;

//item
let storeitem = require('./components/item/create.vue').default;
let item = require('./components/item/index.vue').default;
let edititem = require('./components/item/edit.vue').default;

//substucture
let storesubstructure = require('./components/substructure/create.vue').default;
let substructure = require('./components/substructure/index.vue').default;
let editsubstructure = require('./components/substructure/edit.vue').default;

//Project
let storeproject = require('./components/project/create.vue').default;
let project = require('./components/project/index.vue').default;
let editproject = require('./components/project/edit.vue').default;
//Part
let storepart = require('./components/part/create.vue').default;
let part = require('./components/part/index.vue').default;
let editpart = require('./components/part/edit.vue').default;
//Subcontractor
let storesubcontractor = require('./components/subcontractor/create.vue').default;
let subcontractor = require('./components/subcontractor/index.vue').default;
let editsubcontractor = require('./components/subcontractor/edit.vue').default;

//salary
let salary = require('./components/salary/all_employee.vue').default;
let paysalary = require('./components/salary/create.vue').default;
let allsalary = require('./components/salary/index.vue').default;
let viewsalary = require('./components/salary/viewsalary.vue').default;
let editsalary = require('./components/salary/edit.vue').default;

// Product Component
let storeproduct = require('./components/product/create.vue').default;
let product = require('./components/product/index.vue').default;
let editproduct = require('./components/product/edit.vue').default;

 // Supplier Component
 let storesupplier = require('./components/supplier/create.vue').default;
 let supplier = require('./components/supplier/index.vue').default;
let editsupplier = require('./components/supplier/edit.vue').default;

// Task Component
let storetask = require('./components/task/create.vue').default;
let task = require('./components/task/index.vue').default;
let taskpic = require('./components/task/indexpic.vue').default;
let taskpictures = require('./components/task/taskpictures.vue').default;
let edittask = require('./components/task/edit.vue').default;
let uploadfptask = require('./components/task/uploadfp.vue').default;

// Category Component
let storecategory = require('./components/category/create.vue').default;
let category = require('./components/category/index.vue').default;
let editcategory = require('./components/category/edit.vue').default;

// Customer Component
let storecustomer = require('./components/customer/create.vue').default;
let customer = require('./components/customer/index.vue').default;
let editcustomer = require('./components/customer/edit.vue').default;

//POS Component
let pos = require('./components/pos/pointofsale.vue').default;

//Order Component
let order = require('./components/order/order.vue').default;
let searchorder = require('./components/order/search.vue').default;
let vieworder = require('./components/order/vieworder.vue').default;

//RFI Component
let indexrfi = require('./components/rfi/index.vue').default;
let editrfi = require('./components/rfi/edit.vue').default;
let createrfi = require('./components/rfi/create.vue').default;
let inspectorrfi = require('./components/rfi/inspector.vue').default;
let inspectorallrfi = require('./components/rfi/inspectorall.vue').default;
let statusrfi = require('./components/rfi/status\.vue').default;
//stock
let stock = require('./components/product/stock.vue').default;
let eidtstock = require('./components/product/edit-stock.vue').default;

//Step Component
let indexstep = require('./components/step/index.vue').default;
let editstep = require('./components/step/edit.vue').default;
let createstep = require('./components/step/create.vue').default;



export const routes = [
    { path: '/', component: login, name:'/' },
    { path: '/register', component: register, name: 'register' },
    { path: '/forget', component: forget, name: 'forget' },
    { path: '/home', component: home, name: 'home' },
    { path: '/logout', component: logout, name: 'logout' },

  // Employee Routes
  { path: '/store-employee', component: storeemployee, name:'store-employee'},
  { path: '/employee', component: employee, name:'employee'},
  { path: '/edit-employee/:id', component: editemployee, name:'edit-employee'},


    //Expense
    { path: '/store-expense', component: storeexpense, name: 'store-expense' },
    { path: '/expense', component: expense, name: 'expense' },
    { path: '/edit-expense/:id', component: editexpense, name: 'edit-expense' },

    //Drawing
    { path: '/store-transmittal', component: storetransmittal, name: 'store-transmittal' },
    { path: '/transmittal', component: transmittalidex, name: 'transmittalidex' },
    { path: '/edit-transmittal/:id', component: transmittaledit, name: 'edit-transmittal' },
    { path: '/transmittal/:id', component: transmittaldetails, name: 'transmittaldetails' },
    { path: '/drawing/:id', component: drawing, name: 'drawing' },
    { path: '/store-drawing', component: storedrawing, name: 'store-drawing' },
    { path: '/drawing', component: drawingindex, name: 'drawingindex' },
    { path: '/edit-drawingdet/:id', component: editdrawing, name: 'edit-drawing' },
    { path: '/editattach-drawing/:file_id', component: editattachdrawing, name: 'editattach-drawing' },

    //Issue
    { path: '/store-issue', component: storeissue, name: 'store-issue' },
    { path: '/issue', component: issue, name: 'issue' },
    { path: '/issueall', component: issueall, name: 'issueall' },
    { path: '/edit-issue/:id', component: editissue, name: 'edit-issue' },
    { path: '/attach-issue/:issue_id', component: attachissue, name: 'attach-issue' },
    { path: '/editattach-issue/:file_id', component: editattachissue, name: 'editattach-issue' },

    //Item
    { path: '/store-item', component: storeitem, name: 'store-item' },
    { path: '/item', component: item, name: 'item' },
    { path: '/edit-item/:id', component: edititem, name: 'edit-item' },

    //substructure
    { path: '/store-substructure', component: storesubstructure, name: 'store-substructure' },
    { path: '/substructure', component: substructure, name: 'substructure' },
    { path: '/edit-substructure/:id', component: editsubstructure, name: 'edit-substructure' },

    //Project
    { path: '/store-project', component: storeproject, name: 'store-project' },
    { path: '/project', component: project, name: 'project' },
    { path: '/edit-project/:id', component: editproject, name: 'edit-project' },
    
    //part
    { path: '/store-part', component: storepart, name: 'store-part' },
    { path: '/part', component: part, name: 'part' },
    { path: '/edit-part/:id', component: editpart, name: 'edit-part' },
    
    //Subcontractor
    { path: '/store-subcontractor', component: storesubcontractor, name: 'store-subcontractor' },
    { path: '/subcontractor', component: subcontractor, name: 'subcontractor' },
    { path: '/edit-subcontractor/:id', component: editsubcontractor, name: 'edit-subcontractor' },

    //Salary Routes
    { path: '/given-salary', component: salary, name: 'given-salary' },
    { path: '/pay-salary/:id', component: paysalary, name: 'pay-salary' },
    { path: '/salary', component: allsalary, name: 'salary' },
    { path: '/view-salary/:id', component: viewsalary, name: 'view-salary' },
    { path: '/edit-salary/:id', component: editsalary, name: 'edit-salary' },

    //Task
    { path: '/store-task', component: storetask, name: 'store-task' },
    { path: '/task', component: task, name: 'task' },
    { path: '/taskpic', component: taskpic, name: 'taskpic' },
    { path: '/taskpic/:id', component: taskpictures, name: 'taskpictures' },
    { path: '/edit-task/:id', component: edittask, name: 'edit-task' },
    { path: '/uploadfp-task/:id', component: uploadfptask, name: 'uploadfp-task' },

  // Product Routes
  { path: '/store-product', component: storeproduct, name:'store-product'},
  { path: '/product', component: product, name:'product'},
  { path: '/edit-product/:id', component: editproduct, name:'edit-product'},


    //Stock
    { path: '/stock', component: stock, name: 'stock' },
    { path: '/eidt-stock/:id', component: eidtstock, name: 'edit-stock' },

      // Supplier Routes
    { path: '/store-supplier', component: storesupplier, name:'store-supplier'},
    { path: '/supplier', component: supplier, name:'supplier'},
    { path: '/edit-supplier/:id', component: editsupplier, name: 'edit-supplier' },

    // Category Routes
  { path: '/store-category', component: storecategory, name:'store-category'},
  { path: '/category', component: category, name:'category'},
  { path: '/edit-category/:id', component: editcategory, name:'edit-category'},

    // RFI Routes
    { path: '/store-rfi', component: createrfi, name:'store-rfi'},
    { path: '/rfi', component: indexrfi, name:'rfi'},
    { path: '/edit-rfi/:id', component: editrfi, name:'edit-rfi'},
    { path: '/inspectorall-rfi', component: inspectorallrfi, name:'inspectorall-rfi'},
    { path: '/inspector-rfi', component: inspectorrfi, name: 'inspector-rfi' },
    { path: '/status-rfi', component: statusrfi, name:'status-rfi'},

  // Customer Routes
   { path: '/store-customer', component: storecustomer, name:'store-customer'},
   { path: '/customer', component: customer, name:'customer'},
    { path: '/edit-customer/:id', component: editcustomer, name: 'edit-customer' },

    // POS Routes
    { path: '/pos', component: pos, name:'pos'},

    // Order Routes
    { path: '/order', component: order, name:'order'},
    { path: '/searchorder', component: searchorder, name:'searchorder'},
    { path: '/view-order/:id', component: vieworder, name: 'view-order' },

       // Step Routes
       { path: '/store-step', component: createstep, name:'store-step'},
       { path: '/step', component: indexstep, name:'step'},
       { path: '/edit-step/:id', component: editstep, name:'edit-step'},

  ]
