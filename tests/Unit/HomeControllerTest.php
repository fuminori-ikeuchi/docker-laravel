<?php
namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use App\Stock;
use App\Order;


class HomeControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function test_setArray()    // 在庫一覧にすべて表示される
    {
        $response = $this->get(action('HomeController@index'));
        $response->assertSee("ティッシュペーパー", "コンドーム0.01", "TENGA", "ハサミ", "のり", "飲むシリカ500ml");
    }
}