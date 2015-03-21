# laravel-enhanced-form
Extend Laravel forms to add convinient access and helps.
The package is extending the Laravels Html/From package to add additional functionality.


### Example select :

```
{!! Form::ariaSelect('test', [
    ['id' => 0, 'label' => '---++---', 'role' => 'test', 'selected'=>'selected'],
    ['id' => 1, 'label' => 'title->a', 'role' => 'test'],
    ['id' => 2, 'label' => 'title->b', 'role' => 'admi', 'penka' => '1']
], null, [
    'option' => [
        'displayField'=> 'label',
        'valueField' => 'id',
        'aria' => 'role,id'
    ]
, 'placeholder' => 'placeholder text', 'custom-data' => 1, 'aria' => 'custom-data']) !!}
```


Output:

```
<select placeholder="placeholder text" data-custom-data="1" name="test">
    <option value="0" data-id="0" data-role="test">---++---</option>
    <option value="1" data-id="1" data-role="test">title-&gt;a</option>
    <option value="2" data-id="2" data-role="admi">title-&gt;b</option>
</select>
```

### New component using hidden input by default for easy form data access via js for example.

```
{!! Form::aria(['aria' => 'role,myid', 'name' => 'testName'], [
    'value' => 'TEST',
    'role' => "admin",
    'myid' => 1
]) !!}
```

Output:

```
<input name="testName" type="hidden" value="TEST" data-role="admin" data-myid="1">

```

Setting the aria value to a comma separated list will add the matching Model attributes.

##  Setup
After install add to your app.php in providers array:

```
'Illuminate\Html\HtmlServiceProvider',
"Mraiur\EnhancedForm\FormServiceProvider"
```

Add to aliases array:

```
'Form'=> 'Illuminate\Html\FormFacade', 
'HTML'=> 'Illuminate\Html\HtmlFacade'
```
