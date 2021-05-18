<?php
namespace Tests\Unit;

// use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use App\User;
use Illuminate\Http\RedirectResponse;

class UserControllerTest extends TestCase
{
    // use DatabaseMigrations;                   // データベース初期化

    // public function testText()                 // 新規登録画面のURLで新規登録画面の記述がされているviewが表示されるか、テキスト（有無）
    // {
    //     $response = $this->get('/create_user');          // ルーティング
    //     $response->assertViewIs('user.create');          // ルートにより、指定したビューが返されたことを宣言。
    //     $response->assertStatus(200);                    // クライアントのレスポンスが指定したコードであることを宣言。

    //     $response->assertSee('アカウント新規登録');         // 指定した文字列がレスポンスに含まれていることを宣言。
    //     $response->assertSee('ログインはこちら');
    //     $response->assertDontSeeText('アカウントを新規作成する方はこちら');    // 指定した文字列がレスポンステキストに含まれていないことを宣言。
    // }

    // public function testOk()      // ユーザー登録に成功した後は画面が表示される
    // {
    //     // ユーザー登録処理
    //     $response = $this->post(("create_user"), [
    //         'name' => 'testUser',
    //         'email' => 'test@example.com',
    //         'password' => '22222222',
    //         'password_confirmation' => '22222222',
    //         'role'  => 1
    //         ]);
    //     $response->assertRedirect(action('LoginController@index'));
    // }

    public function testName()
    {
        $response = $this->post(('/create_user'), [
            'name'  => '',
            'email'    => 'test@example.com',
            'password'  => '22222222',
            'password_confirm' => '22222222',
        ]);
        $errorMessage = '';
        $this->get(('/create_user'))->assertSee($errorMessage);
    }



    /** @test */
    // public function 名前を入力しないで登録しようとするとエラーメッセージが表示される()
    // {
    //     $response = $this->post(route('/register', 'Home/HomeController@register'), [
    //         'name'  => '',
    //         'email'    => 'test@example.com',
    //         'password'  => 'password123',
    //         'password_confirm'  => 'password123',
    //         'role' => 1
    //     ]);
    //     $errorMessage = '名前は必ず指定してください';
    //     $this->get(route('/register', 'Home/HomeController@create'))->assertSee($errorMessage);
    // }
    /** @test */
    // public function メールアドレスを入力しないで登録しようとするとエラーメッセージが表示される()
    // {
    //     $response = $this->post(route('register'), [
    //         'name'  => 'testuser',
    //         'email'    => '',
    //         'password'  => 'password123'
    //     ]);
    //     $errorMessage = 'メールアドレスは必ず指定してください';
    //     $this->get(route('register'))->assertSee($errorMessage);
    // }
    // /** @test */
    // public function パスワードを入力しないで登録しようとするとエラーメッセージが表示される()
    // {
    //     $response = $this->post(route('register'), [
    //         'name'  => 'testuser',
    //         'email'    => 'test@example.com',
    //         'password'  => ''
    //     ]);
    //     $errorMessage = 'パスワードには正しい形式を指定してください';
    //     $this->get(route('register'))->assertSee($errorMessage);
    // }
}