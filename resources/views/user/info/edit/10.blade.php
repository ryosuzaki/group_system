<form method="POST" action="{{ route('user.info.update',[$base->id]) }}">
    @csrf
    @method('PUT')
    <h2>福祉</h2>

    <p class="h5 mt-4 mb-0">【持っている障害】</p>
    <input type="text" class="form-control" name="info[hindrance]" value="{{$base->info()->info['hindrance']}}">

    <p class="h5 mt-4 mb-0">【要介護認定】</p>
    <div>
        <input type="hidden" id="nurs" name="info[nursing]" value="{{$base->info()->info['nursing']}}">
        <div class="form-check form-check-radio">
            <label class="form-check-label">
                <input type="radio" id="no_pro" class="form-check-input" name="info[nursing]" value="日常生活に問題は無い">日常生活に問題は無い
                <span class="circle">
                    <span class="check"></span>
        　      </span>
            </label>
        </div>
        <div class="form-check form-check-radio">
            <label class="form-check-label">
                <input type="radio" id="sup1" class="form-check-input" name="info[nursing]" value="要支援１">要支援１
                <span class="circle">
                    <span class="check"></span>
                </span>
            </label>
        </div>
        <div class="form-check form-check-radio">
            <label class="form-check-label">
                <input type="radio" id="sup2" class="form-check-input" name="info[nursing]" value="要支援２">要支援２
                <span class="circle">
                    <span class="check"></span>
        　      </span>
            </label>
        </div>
        <div class="form-check form-check-radio">
            <label class="form-check-label">
                <input type="radio" id="nurs1" class="form-check-input" name="info[nursing]" value="要介護１">要介護１
                <span class="circle">
                    <span class="check"></span>
                </span>
            </label>
        </div>
        <div class="form-check form-check-radio">
            <label class="form-check-label">
                <input type="radio" id="nurs2" class="form-check-input" name="info[nursing]" value="要介護２">要介護２
                <span class="circle">
                    <span class="check"></span>
        　      </span>
            </label>
        </div>
        <div class="form-check form-check-radio">
            <label class="form-check-label">
                <input type="radio" id="nurs3" class="form-check-input" name="info[nursing]" value="要介護３">要介護３
                <span class="circle">
                    <span class="check"></span>
                </span>
            </label>
        </div>
        <div class="form-check form-check-radio">
            <label class="form-check-label">
                <input type="radio" id="nurs4" class="form-check-input" name="info[nursing]" value="要介護４以上">要介護４以上
                <span class="circle">
                    <span class="check"></span>
        　      </span>
            </label>
        </div>
        <div class="form-check form-check-radio">
            <label class="form-check-label">
                <input type="radio" id="help_me" class="form-check-input" name="info[nursing]" value="介護や障害等の申請はしていないが、日常生活に支障があり支援を要している">介護や障害等の申請はしていないが、日常生活に支障があり支援を要している
                <span class="circle">
                    <span class="check"></span>
                </span>
            </label>
        </div>
    </div>
    
    <p class="h5 mt-4 mb-0">【介護者の有無】</p>
    <div>
        <input type="hidden" id="care" name="info[caregiver]" value="{{$base->info()->info['caregiver']}}">
        <div class="form-check form-check-radio">
            <label class="form-check-label">
                <input type="radio" id="care_on" class="form-check-input" name="info[caregiver]" value="有り">有り
                <span class="circle">
                    <span class="check"></span>
            　  </span>
            </label>
        </div>
        <div class="form-check form-check-radio">
            <label class="form-check-label">
                <input type="radio" id="care_off" class="form-check-input" name="info[caregiver]" value="無し">無し
                <span class="circle">
                    <span class="check"></span>
                </span>
            </label>
        </div>
    </div>

    <p class="h5 mt-4 mb-0">【介護者との続柄】</p>
    <input type="text" class="form-control" name="info[caregiver_posi]" value="{{$base->info()->info['caregiver_posi']}}">

    <p class="h5 mt-4 mb-0">【介護サービスの有無】</p>
    <div>
        <input type="hidden" id="serv" name="info[service]" value="{{$base->info()->info['service']}}">
        <div class="form-check form-check-radio">
            <label class="form-check-label">
                <input type="radio" id="serv_on" class="form-check-input" name="info[service]" value="有り">有り
                <span class="circle">
                    <span class="check"></span>
            　  </span>
            </label>
        </div>
        <div class="form-check form-check-radio">
            <label class="form-check-label">
                <input type="radio" id="serv_off" class="form-check-input" name="info[service]" value="無し">無し
                <span class="circle">
                    <span class="check"></span>
                </span>
            </label>
        </div>
    </div>

    <p class="h5 mt-4 mb-0">【サービス内容】</p>
    <input type="text" class="form-control" name="info[use_service]" value="{{$base->info()->info['use_service']}}">

    <p class="h5 mt-4 mb-0">【利用サービス施設名称】</p>
    <input type="text" class="form-control" name="info[institution]" value="{{$base->info()->info['institution']}}">

    <p class="h5 mt-4 mb-0">【在宅酸素療法】</p>
    <div>
        <input type="hidden" id="oxy" name="info[oxygen]" value="{{$base->info()->info['oxygen']}}">
        <div class="form-check form-check-radio">
            <label class="form-check-label">
                <input type="radio" id="oxy_on" class="form-check-input" name="info[oxygen]" value="有り">有り
                <span class="circle">
                    <span class="check"></span>
            　  </span>
            </label>
        </div>
        <div class="form-check form-check-radio">
            <label class="form-check-label">
                <input type="radio" id="oxy_off" class="form-check-input" name="info[oxygen]" value="無し">無し
                <span class="circle">
                    <span class="check"></span>
                </span>
            </label>
        </div>
    </div>

    <p class="h5 mt-4 mb-0">【介助者の有無】</p>
    <div>
        <input type="hidden" id="assis" name="info[assistance]" value="{{$base->info()->info['assistance']}}">
        <div class="form-check form-check-radio">
            <label class="form-check-label">
                <input type="radio" id="assis_on" class="form-check-input" name="info[assistance]" value="有り">有り
                <span class="circle">
                    <span class="check"></span>
            　  </span>
            </label>
        </div>
        <div class="form-check form-check-radio">
            <label class="form-check-label">
                <input type="radio" id="assis_off" class="form-check-input" name="info[assistance]" value="無し">無し
                <span class="circle">
                    <span class="check"></span>
                </span>
            </label>
        </div>
    </div>

    <h2>住まい</h2>
    <div><p class="h5 mt-4 mb-0">【同居人の有無】</p>
        <input type="hidden" id="house" name="info[housemate]" value="{{$base->info()->info['housemate']}}">
        <div class="form-check form-check-radio">
            <label class="form-check-label">
                <input type="radio" id="house_yes" class="form-check-input" name="info[housemate]" value="有り">有り
                <span class="circle">
                    <span class="check"></span>
        　      </span>
            </label>
        </div>
        <div class="form-check form-check-radio">
            <label class="form-check-label">
                <input type="radio" id="house_no" class="form-check-input" name="info[housemate]" value="無し">無し
                <span class="circle">
                    <span class="check"></span>
                </span>
            </label>
        </div>
        <p class="h5 mt-4 mb-0">【最寄りの避難場所】</p>
        <input type="text" class="form-control" name="info[shelter]" value="{{$base->info()->info['shelter']}}">
    </div>
    <button type="submit" class="btn btn-primary btn-block mt-4">
        登録
    </button>
</div>
    
</form>
<script>
    var caregiver_ary = ["care_on","care_off"];
    var nursing_ary = ["","","no_pro","sup1","sup2","nurs1","nurs2","nurs3","nurs4","help_me"];
    var service_ary = ["serv_on","serv_off"];
    var oxygen_ary = ["oxy_on","oxy_off"];
    var assistance_ary = ["assis_on","assis_off"];
    var housemate_ary = ["house_yes","house_no"];
    var check_ary = ["有り","無し","日常生活に問題ない","要支援１","要支援２","要介護１","要介護２","要介護３","要介護４以上","介護や障害等の申請はしていないが、日常生活に支障があり支援を要している"];
    var ary = ["nurs",nursing_ary,"care",caregiver_ary,"serv",service_ary,"oxy",oxygen_ary,"assis",assistance_ary,"house",housemate_ary];
    for(var i = 0;i < ary.length;){
        var check = document.getElementById(ary[i]);
        check = check.value;
        i++;
        for(var j = 0;j < check_ary.length;j++){
            if(check == check_ary[j]){
                var checked = document.getElementById(ary[i][j]);
                console.log(ary[i][j]);
                checked.setAttribute("checked","");
            }
        }
        i++;
    }
</script>  
