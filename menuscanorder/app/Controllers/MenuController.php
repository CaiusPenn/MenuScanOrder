<?php namespace App\Controllers;

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

class MenuController extends BaseController
{
    public function __construct()
    {
        helper('url'); 
        $this->session = session();
    }

    public function index()
    {
        return view('landingpage');
    }

    public function login()
    {
        return view('login');
    }

    //Sign up/login-------------------------------------------------------------
    public function signin()
    {
        $usermodel = new \App\Models\UserModel();
        $menumodel = new \App\Models\MenuModel();
        $userrolesmodel = new \App\Models\UserRolesModel();
        $rolesmodel = new \App\Models\RolesModel();
        
        
        $data = $this->request->getPost();
        $user = $usermodel->where('username', $data['username'])->first();
        
        
        if ($user && password_verify($data['password'], $user['password_hash'])) {
            $this->session->setFlashdata('success', 'User successfully logged in.');
            $_SESSION['user_id'] = $user['id'];

            session()->set(['is_logged_in' => true]);
            
            $user_roles = $userrolesmodel->where('user_id', $user['id'])->findall();
            
            foreach ($user_roles as $user_role) {
                $role_details = $rolesmodel->find($user_role['role_id']);
            
                if ($role_details && $role_details['name'] === 'Admin') {
                    session()->set(['is_admin' => true]);
                    break; 
                }
            }
            
            if (session()->get('is_admin')) {
                return redirect()->to('/admin');
            } else {
                return redirect()->to('/menupage');
            }

        } else {
            $this->session->setFlashdata('error', 'User does not exist.');
            return redirect()->to('/login');
        }

    }

    public function createuser()
    {
        
        $model = new \App\Models\UserModel(); 

        $data = $this->request->getPost();

        $hashedPassword = password_hash($data['password_hash'], PASSWORD_DEFAULT);

        $data['password_hash'] = $hashedPassword;
    
        if ($model->insert($data)) {
            $this->session->setFlashdata('success', 'User added successfully.');
        } else {
            $this->session->setFlashdata('error', 'Failed to add user. Please try again.');
        }
        
        return redirect()->to('/');
    }

    public function logout()
    {
        $session = session();
        
        $session->remove(['is_logged_in', 'is_admin']);
        
        return redirect()->to('/');
    }

    //Menu fuctionality-------------------------------------------------------------
    public function displaymenu() 
    {
        $menumodel = new \App\Models\MenuModel();
        $usermodel = new \App\Models\UserModel();

        $menus = $menumodel->where('user_id', $_SESSION['user_id'])->findAll();
        $user = $usermodel->where('id', $_SESSION['user_id'])->first();
        $menulist['menus'] = $menus;
        $menulist['user'] = $user;
        
        return view('menupage', $menulist);
    }

    public function addmenu($id = null)
    {
        $menumodel = new \App\Models\MenuModel();
        $usermodel = new \App\Models\UserModel();
        $userId = $_SESSION['user_id'];
        
        if ($this->request->getMethod() === 'post') {
            $data = $this->request->getPost();
            $data['user_id'] = $userId;
            if ($id === null) {
                if ($menumodel->insert($data)) {
                    $this->session->setFlashdata('success', 'Menu added successfully.');
                } else {
                    $this->session->setFlashdata('error', 'Failed to add menu. Please try again.');
                }
            } else {
                if ($menumodel->update($id, $data)) {
                    $this->session->setFlashdata('success', 'Menu updated successfully.');
                } else {
                    $this->session->setFlashdata('error', 'Failed to update menu. Please try again.');
                }
            }
            return redirect()->to('menupage');
        }

        $data['menu'] = ($id === null) ? null : $menumodel->find($id);


        return view('addmenu', $data);
    }

    public function deletemenu($id)
    {
        $menumodel = new \App\Models\MenuModel();

        if ($menumodel->delete($id)) {
            $this->session->setFlashdata('success', 'Menu deleted successfully.');
        } else {
            $this->session->setFlashdata('error', 'Failed to delete menu. Please try again.');
        }

        return redirect()->to('/menupage');
    }

    //Itempage functionality-------------------------------------------------------------
    public function displayitem($id = null)
    {
        $itemmodel = new \App\Models\ItemModel();
        $categorymodel = new \App\Models\CategoryModel();

        if ($id !== null){
            $_SESSION['menu_id'] = $id;
        } else {
            $id = $_SESSION['menu_id'];
        }

        $item = $itemmodel->where('menu_id', $id)->findAll();
        $itemlist['item'] = $item;
        $itemlist['menus'] = $id;
        $itemlist['category'] = $categorymodel->where('menu_id', $id)->findAll();

        return view('itempage', $itemlist);
    }

    public function additem($id = null)
    {
        $itemmodel = new \App\Models\ItemModel();
        $categorymodel = new \App\Models\CategoryModel();
        
        if ($this->request->getMethod() === 'post') {
            $data = $this->request->getPost();
            $data['menu_id'] =  $_SESSION['menu_id'];

            $category = $categorymodel->find($data['category_id']);
            $data['category_name'] = $category['category_name'];

            if ($id === null) {
                if ($itemmodel->insert($data)) {
                    $this->session->setFlashdata('success', 'Item added successfully.');
                } else {
                    $this->session->setFlashdata('error', 'Failed to add item. Please try again.');
                }
            } else {
                if ($itemmodel->update($id, $data)) {
                    $this->session->setFlashdata('success', 'Item updated successfully.');
                } else {
                    $this->session->setFlashdata('error', 'Failed to update item. Please try again.');
                }
            }
            return redirect()->to('itempage');
        }

        $data['item'] = ($id === null) ? null : $itemmodel->find($id);
        $data['category'] = $categorymodel->where('menu_id', $_SESSION['menu_id'])->findAll();

        return view('additem', $data);    
    }

    public function itemdelete($id)
    {
        $itemmodel = new \App\Models\ItemModel();

        if ($itemmodel->delete($id)) {
            $this->session->setFlashdata('success', 'Item deleted successfully.');
        } else {
            $this->session->setFlashdata('error', 'Failed to delete item. Please try again.');
        }

        return redirect()->to('/itempage');
    }

    public function addCategory($id = null)
    {
        $categorymodel = new \App\Models\CategoryModel();
        
        
        if ($this->request->getMethod() === 'post') {
            $data = $this->request->getPost();
            $data['menu_id'] =  $_SESSION['menu_id'];
            if ($id === null) {
                if ($categorymodel->insert($data)) {
                    $this->session->setFlashdata('success', 'Item added successfully.');
                } else {
                    $this->session->setFlashdata('error', 'Failed to add item. Please try again.');
                }
            } else {
                if ($categorymodel->update($id, $data)) {
                    $this->session->setFlashdata('success', 'Item updated successfully.');
                } else {
                    $this->session->setFlashdata('error', 'Failed to update item. Please try again.');
                }
            }
            return redirect()->to('itempage');
        }

        $data['category'] = ($id === null) ? null : $categorymodel->find($id);


        return view('addcategory', $data);    
    }

    public function categorydelete($id)
    {
        $categorymodel = new \App\Models\CategoryModel();

        if ($categorymodel->delete($id)) {
            $this->session->setFlashdata('success', 'Item deleted successfully.');
        } else {
            $this->session->setFlashdata('error', 'Failed to delete item. Please try again.');
        }

        return redirect()->to('/itempage');
    }

    //Adminpage -------------------------------------------------------------
    public function admin()
    {
        $model = new \App\Models\UserModel();
        $search = $this->request->getGet('search');
        
        if (!empty($search)) {
            $conditions = [];
            foreach ($model->allowedFields as $field) {
                $conditions[] = "$field LIKE '%$search%'";
            }
            
            $whereClause = implode(' OR ', $conditions);
            $users = $model->where($whereClause)->orderBy('username', 'ASC')->findAll();
        } else {
            $users = $model->orderBy('username', 'ASC')->findAll();
        }
        $data['users'] = $users;
        
        return view('admin', $data);
    }

    public function adduser($id = null)
    {
        $model = new \App\Models\UserModel();

        if ($this->request->getMethod() === 'post') {
            $data = $this->request->getPost();

            $hashedPassword = password_hash($data['password_hash'], PASSWORD_DEFAULT);
            $data['password_hash'] = $hashedPassword;

            if ($id === null) {
                if ($model->insert($data)) {
                    $this->session->setFlashdata('success', 'User added successfully.');
                } else {
                    $this->session->setFlashdata('error', 'Failed to add user. Please try again.');
                }
            } else {
                if ($model->update($id, $data)) {
                    $this->session->setFlashdata('success', 'User updated successfully.');
                } else {
                    $this->session->setFlashdata('error', 'Failed to update user. Please try again.');
                }
            }

            return redirect()->to('/admin');
        }

        $data['users'] = ($id === null) ? null : $model->find($id);

        return view('adduser', $data);
    }

    public function userdelete($id)
    {
        $usermodel = new \App\Models\UserModel();

        if ($usermodel->delete($id)) {
            $this->session->setFlashdata('success', 'User deleted successfully.');
        } else {
            $this->session->setFlashdata('error', 'Failed to delete User. Please try again.');
        }

        return redirect()->to('/admin');
    }

    //Menu for customer-------------------------------------------------------------
    public function menu($id, $table_number = null, $order_id = null)
    {
        $itemmodel = new \App\Models\ItemModel();
        $ordermodel = new \App\Models\OrderModel();
        $categorymodel = new \App\Models\CategoryModel();

        $_SESSION['menu_id'] = $id;
        $data['item'] = $itemmodel->where('menu_id', $id)->findAll();
        $data['category'] = $categorymodel->where('menu_id', $id)->findAll();;
        $data['table_number'] = $table_number;
        $data['order_id'] = $order_id;

        return view('menu', $data);
    }

    public function QRgenerate($id = null)
    {
        $usermodel = new \App\Models\UserModel();
        $table_number = $this->request->getGet('table_number');

        $user = $usermodel->find($id);
        $max_table_number = $user['num_tables'];

        $qr_code = QrCode::create('https://infs3202-9b96e30a.uqcloud.net/menuscanorder/menu/' . $id .'/'. $table_number);
        $writer = new PngWriter;
        $result = $writer->write($qr_code);

        $this->response->setHeader('Content-Type', $result->getMimeType());

        $this->response->setBody($result->getString());

        return $this->response->send();
    
    }

    //Manager order view functionality-------------------------------------------------------------
    public function managervieworder()
    {
        $ordermodel = new \App\Models\OrderModel();
        $menumodel = new \App\Models\MenuModel();

        $menus = $menumodel->where('user_id', $_SESSION['user_id'])->findAll();
        
        $orderdata = ['orders' => []];

        foreach ($menus as $menu) {
            $data = $ordermodel->where('menu_id', $menu['id'])->findAll();
            foreach ($data as $it){
                $orderdata['orders'][] = $it;
            }
        }
        
        return view("managerorder", $orderdata);
    }

    public function updateorder($order_id)
    {
        $ordermodel = new \App\Models\OrderModel();

        $order = $ordermodel->where('id', $order_id)->first();

        if ($order['is_complete'] == 0) {
            $order['is_complete'] = 1; 

            $ordermodel->update($order_id, $order);
        } else {
            $order['is_complete'] = 0; 

            $ordermodel->update($order_id, $order);
        }

        return redirect()->to("managerorder");

    }

    public function archiveorder($order_id)
    {
        $ordermodel = new \App\Models\OrderModel();

        $order = $ordermodel->where('id', $order_id)->first();

        if ($order['archived'] == 0) {
            $order['archived'] = 1; 

            $ordermodel->update($order_id, $order);
        } else {
            $order['archived'] = 0; 

            $ordermodel->update($order_id, $order);
        }
        return redirect()->to("managerorder");
    }

    public function viewarchives()
    {
        $ordermodel = new \App\Models\OrderModel();
        $menumodel = new \App\Models\MenuModel();

        $menus = $menumodel->where('user_id', $_SESSION['user_id'])->findAll();
        
        $orderdata = ['orders' => []];

        foreach ($menus as $menu) {
            $data = $ordermodel->where('menu_id', $menu['id'])->findAll();
            foreach ($data as $it){
                $orderdata['orders'][] = $it;
            }
        }
        
        return view("archivedorders", $orderdata);
    }

    //Customer order view functionality-------------------------------------------------------------
    public function customervieworder($order_id = null)
    {
        $ordermodel = new \App\Models\OrderModel();
        $itemmodel = new \App\Models\ItemModel();
        $placeditemmodel = new \App\Models\PlacedItemModel();

        
        $placed_items = $placeditemmodel->where('order_id', $order_id)->findAll();

        $placed_items_with_names = array();

        foreach ($placed_items as $placed_item) {
            $item_details = $itemmodel->where('id', $placed_item['item_id'])->first();
        
            if ($item_details) {
                $placed_item['item_name'] = $item_details['item_name'];
                $placed_item['item_price'] = $item_details['price'];
                $placed_item['item_id'] = $item_details['id'];
        
                $placed_items_with_names[] = $placed_item;
            }
        }

        $last_added_item = $placeditemmodel->where('order_id', $order_id)->orderBy('id', 'DESC')->first();
        $added_item_id = ($last_added_item) ? $last_added_item['item_id'] : null;;

        $table_number = null;
        
        $current_order = $ordermodel->where('id', $order_id)->first();
        if ($current_order !== null){
            $table_number = $current_order['table_number'];
        }

        return view("vieworder", ['placed_items' => $placed_items_with_names, 'order_id' => $order_id, 'table_number' => $table_number, 'ret_id' => $added_item_id]);
    }

    public function order($table_number, $item_id = null, $order_id = null)
    {
        $ordermodel = new \App\Models\OrderModel();
        $itemmodel = new \App\Models\ItemModel();
        $placeditemmodel = new \App\Models\PlacedItemModel();


        if ($order_id == null){
            $orderdata = [
                'menu_id' => $_SESSION['menu_id'],
                'table_number' => $table_number,
                'is_complete' => false,
            ];
            $ordermodel->insert($orderdata);
            $insertedId = $ordermodel->getInsertID();
            $order_id = $insertedId;
        }
        
        $data = [
            'order_id' => $order_id,
            'item_id' => $item_id,
        ];

        
        $placeditemmodel->insert($data);
        
        $order_details = $ordermodel->where('id', $order_id)->first();
        $table_number = $order_details['table_number'];

        return $this->menu($_SESSION['menu_id'], $table_number, $order_id);
    }

    public function backtomenu($table_number = null, $item_id = null, $order_id = null)
    {
        $ordermodel = new \App\Models\OrderModel();
        $itemmodel = new \App\Models\ItemModel();
        $placeditemmodel = new \App\Models\PlacedItemModel();

        $order_details = $ordermodel->where('id', $order_id)->first();
        if ($order_details !==null){
            $table_number = $order_details['table_number'];
        }

        return $this->menu($_SESSION['menu_id'], $table_number, $order_id);
    }

    public function placeditemdelete($id, $order_id = null)
    {
        $placeditemmodel = new \App\Models\PlacedItemModel();

        if ($placeditemmodel->delete($id)) {
            $this->session->setFlashdata('success', 'Item deleted successfully.');
        } else {
            $this->session->setFlashdata('error', 'Failed to delete item. Please try again.');
        }

        return $this->customervieworder($order_id);

    }

    public function confirmorder($order_id)
    {
        return view("confirmedorder", ['order_id' => $order_id]);
    }

}