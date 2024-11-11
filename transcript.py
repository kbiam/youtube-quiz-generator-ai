import sys
import json
from pydub import AudioSegment
import whisper

def convert_webm_to_wav(webm_file):
    # print("running")
    wav_file = webm_file.replace('.webm', '.wav')
    audio = AudioSegment.from_file(webm_file, format='webm')  # Specify input format
    audio.export(wav_file, format='wav')  # Export as WAV
    return wav_file

def transcribe_audio(audio_file):
    model = whisper.load_model("tiny")
    result = model.transcribe(audio_file)
    # print(result['text'])  # Directly print the transcription result
    return result['text']

if __name__ == "__main__":
    audio_file = sys.argv[1]
    if audio_file.endswith('.webm'):
        audio_file = convert_webm_to_wav(audio_file)
    transcription_results = transcribe_audio(audio_file)
    print(json.dumps(transcription_results))  # Return transcription in JSON format
