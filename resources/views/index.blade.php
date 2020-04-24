<form action="{{url('/doadd')}}"method="post">
    <table>
    @csrf
        <tr>
            <td>名字</td>
            <td><input type="text"name="name"></td>
        </tr>
        <tr>
            <td>行政</td>
            <td><input type="text"name="test"></td>
        </tr>
        <tr>
        <input type="submit" value="提交">
        </tr>
    </table>
</form>
