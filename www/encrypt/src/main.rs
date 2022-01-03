fn encrypt(key: &str, pass: &str) -> String{
  // auth key
  let key = if key.len() < 32 {
    "we_are_common_but_love_another!!"
  }else{
    key
  };
  // repeat pass until length > 32
  let pass = if pass.len() < 32 {
    pass.repeat(32 / pass.len() + 1)
  }else {
    String::from(pass)
  }[0..32].to_string();

  let mut enc = String::from(""); // encrypted pass degist
  let mut index = 0;
  let time_bytes = key.as_bytes();
  for item in pass.bytes(){
    let k = (item ^ time_bytes[index]) % 26 + 97; // trans visible char
    enc.push(k as char);
    index += 1;
  }
  return enc;
}

fn main() {
  // println!("{}", encrypt("aasfsagerhtykyuloiulotiuirgarefd", encrypt("", "fasus").as_str()));
  println!("{}", encrypt("xj156gjameht708bb52a8mlexitkr71q", "1").as_str());
}